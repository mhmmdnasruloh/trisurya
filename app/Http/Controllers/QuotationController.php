<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('quotations.form', compact('quotation', 'customers', 'sales', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'sales_id' => 'required',
            'date' => 'required|date',
            'status' => 'required',
            'items' => 'required|array|min:1'
        ]);

        DB::transaction(function () use ($request) {
            $data = $request->except(['items', '_token', '_method']);
            $data['number'] = $this->generateNumber();
            if (empty($data['approved_date'])) {
                $data['approved_date'] = null;
            }
            if (empty($data['closed_date'])) {
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
        });

        return redirect()->route('quotations.index')->with('success', 'Penawaran berhasil dibuat.');
    }

    public function show(Quotation $quotation)
    {
        $quotation->load('items.product', 'customer', 'sales');
        return view('quotations.print', compact('quotation'));
    }

    public function edit(Quotation $quotation)
    {
        $quotation->load('items.product');
        $customers = Customer::orderBy('name')->get();
        $sales = User::where('role', 'Sales')->orderBy('fullname')->get();
        $products = Product::orderBy('name')->get();
        return view('quotations.form', compact('quotation', 'customers', 'sales', 'products'));
    }

    public function update(Request $request, Quotation $quotation)
    {
        $request->validate([
            'customer_id' => 'required',
            'sales_id' => 'required',
            'date' => 'required|date',
            'status' => 'required',
            'items' => 'required|array|min:1'
        ]);

        DB::transaction(function () use ($request, $quotation) {
            // Kembalikan stock dari item lama
            $quotation->load('items');
            $this->restoreStock($quotation);

            $data = $request->except(['items', '_token', '_method', 'number']);
            if (empty($data['approved_date'])) {
                $data['approved_date'] = null;
            }
            if (empty($data['closed_date'])) {
                $data['closed_date'] = null;
            }
            $quotation->update($data);
            
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
        });

        return redirect()->route('quotations.index')->with('success', 'Penawaran berhasil diubah.');
    }

    public function destroy(Quotation $quotation)
    {
        // Kembalikan stock saat quotation dihapus
        $quotation->load('items');
        $this->restoreStock($quotation);

        $quotation->items()->delete();
        $quotation->delete();
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
