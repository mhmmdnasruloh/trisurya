<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\QuotationStatusHistory;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuotationController extends Controller
{
    private function generateNumber()
    {
        $year = date('Y');
        $prefix = "QUO-{$year}-";
        $last = Quotation::where('number', 'like', $prefix . '%')
            ->orderBy('number', 'desc')
            ->value('number');

        if ($last) {
            $lastNum = (int) substr($last, strlen($prefix));
            $next = $lastNum + 1;
        } else {
            $next = 1;
        }

        return $prefix . str_pad($next, 4, '0', STR_PAD_LEFT);
    }

    public function index(Request $request)
    {
        $query = Quotation::with(['customer', 'sales'])
            ->orderBy('id', 'desc')
            ->orderBy('date', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('number', 'like', '%' . $search . '%')
                  ->orWhere('status', 'like', '%' . $search . '%')
                  ->orWhereHas('customer', function ($q2) use ($search) {
                      $q2->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('sales', function ($q2) use ($search) {
                      $q2->where('fullname', 'like', '%' . $search . '%');
                  });
            });
        }

        $quotations = $query->paginate(20)->appends($request->except('page'));
        return view('quotations.index', compact('quotations'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $sales = User::where('role', 'Sales')->orderBy('fullname')->get();
        $products = Product::orderBy('name')->get();
        $quotation = new Quotation();
        $quotation->number = $this->generateNumber();
        $existingItems = old('items', []);
        return view('quotations.form', compact('quotation', 'customers', 'sales', 'products', 'existingItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'sales_id' => 'required',
            'date' => 'required|date',
            'status' => 'required',
            'approved_date' => 'nullable|date|required_if:status,Approved',
            'closed_date' => 'nullable|date|required_if:status,Closed',
            'items' => 'required|array|min:1'
        ]);

        DB::transaction(function () use ($request) {
            $data = $request->except(['items', '_token', '_method']);
            $data['number'] = $this->generateNumber();
            $data['created_by'] = auth()->id();
            $data['updated_by'] = auth()->id();
            if ($data['status'] !== 'Approved') {
                $data['approved_date'] = null;
            }
            if ($data['status'] !== 'Closed') {
                $data['closed_date'] = null;
            }
            $quotation = Quotation::create($data);
            
            $total = 0;
            foreach ($request->items as $item) {
                QuotationItem::create([
                    'quotation_id' => $quotation->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'discount' => $item['discount'] ?? 0,
                ]);
                $sub = ($item['price'] * $item['quantity']) * (1 - ($item['discount'] ?? 0)/100);
                $total += $sub;
            }
            
            $quotation->update(['total' => $total]);

            // Kurangi stock produk saat quotation dibuat
            $quotation->load('items');
            $this->reduceStock($quotation);

            Log::info(sprintf('[Quotation] %s membuat quotation %s (status=%s, total=%s)', auth()->user()?->fullname ?? 'system', $quotation->number, $quotation->status, $quotation->total));
        });

        return redirect()->route('quotations.index')->with('success', 'Penawaran berhasil dibuat.');
    }

    public function show(Quotation $quotation)
    {
        $quotation->load('items.product', 'customer', 'sales', 'createdBy', 'updatedBy');
        Log::info(sprintf('[Quotation] %s membuka/cetak quotation %s', auth()->user()?->fullname ?? 'system', $quotation->number));
        return view('quotations.print', compact('quotation'));
    }

    public function edit(Quotation $quotation)
    {
        if (!auth()->user()?->hasFullAccess()) {
            abort(403, 'Hanya owner dan admin yang dapat mengedit quotation.');
        }

        $quotation->load('items.product', 'createdBy', 'updatedBy');
        $statusHistories = $quotation->statusHistories()
            ->with('user')
            ->latest('created_at')
            ->take(10)
            ->get()
            ->reverse()
            ->values();

        $existingItems = old('items', $quotation->items->map(function($item) {
            return [
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'discount' => $item->discount,
            ];
        })->toArray());

        $customers = Customer::orderBy('name')->get();
        $sales = User::where('role', 'Sales')->orderBy('fullname')->get();
        $products = Product::orderBy('name')->get();
        return view('quotations.form', compact('quotation', 'customers', 'sales', 'products', 'statusHistories', 'existingItems'));
    }

    public function update(Request $request, Quotation $quotation)
    {
        if (!auth()->user()?->hasFullAccess()) {
            abort(403, 'Hanya owner dan admin yang dapat mengubah quotation.');
        }

        $request->validate([
            'customer_id' => 'required',
            'sales_id' => 'required',
            'date' => 'required|date',
            'status' => 'required',
            'approved_date' => 'nullable|date|required_if:status,Approved',
            'closed_date' => 'nullable|date|required_if:status,Closed',
            'items' => 'required|array|min:1'
        ]);

        DB::transaction(function () use ($request, $quotation) {
            // Kembalikan stock dari item lama
            $quotation->load('items');
            $this->restoreStock($quotation);

            $data = $request->except(['items', '_token', '_method', 'number']);
            $data['updated_by'] = auth()->id();
            if ($data['status'] !== 'Approved') {
                $data['approved_date'] = null;
            }
            if ($data['status'] !== 'Closed') {
                $data['closed_date'] = null;
            }
            $oldStatus = $quotation->status;
            $quotation->update($data);

            if ($oldStatus !== $data['status']) {
                QuotationStatusHistory::create([
                    'quotation_id' => $quotation->id,
                    'user_id' => auth()->id(),
                    'old_status' => $oldStatus,
                    'new_status' => $data['status'],
                ]);
            }
            
            $quotation->items()->delete();
            $total = 0;
            foreach ($request->items as $item) {
                QuotationItem::create([
                    'quotation_id' => $quotation->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'discount' => $item['discount'] ?? 0,
                ]);
                $sub = ($item['price'] * $item['quantity']) * (1 - ($item['discount'] ?? 0)/100);
                $total += $sub;
            }
            $quotation->update(['total' => $total]);

            // Kurangi stock dari item baru (kecuali status Closed — stock tetap habis)
            $quotation->load('items');
            $this->reduceStock($quotation);

            Log::info(sprintf('[Quotation] %s mengubah quotation %s (status=%s, total=%s)', auth()->user()?->fullname ?? 'system', $quotation->number, $quotation->status, $quotation->total));
        });

        return redirect()->route('quotations.index')->with('success', 'Penawaran berhasil diubah.');
    }

    public function destroy(Quotation $quotation)
    {
        if (!auth()->user()?->isOwner() && !auth()->user()?->isAdmin()) {
            abort(403, 'Hanya owner dan admin yang dapat menghapus quotation.');
        }

        if ($quotation->invoices()->exists()) {
            return back()->with('error', 'Tidak bisa menghapus quotation karena sudah ada invoice yang terhubung. Hapus invoice terlebih dahulu.');
        }

        // Kembalikan stock saat quotation dihapus
        $quotation->load('items');
        $this->restoreStock($quotation);

        $quotation->items()->delete();
        $quotation->delete();

        Log::info(sprintf('[Quotation] %s menghapus quotation %s', auth()->user()?->fullname ?? 'system', $quotation->number));
        return back()->with('success', 'Penawaran berhasil dihapus.');
    }

    /**
     * Kurangi stock produk berdasarkan item quotation
     */
    private function reduceStock(Quotation $quotation)
    {
        foreach ($quotation->items as $item) {
            Product::where('id', $item->product_id)
                ->decrement('stock', $item->quantity);
        }
    }

    /**
     * Kembalikan stock produk berdasarkan item quotation
     */
    private function restoreStock(Quotation $quotation)
    {
        foreach ($quotation->items as $item) {
            Product::where('id', $item->product_id)
                ->increment('stock', $item->quantity);
        }
    }
}
