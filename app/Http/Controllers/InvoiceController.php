<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Quotation;
use App\Models\Cashflow;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    private function generateNumber()
    {
        $year = date('Y');
        $prefix = "INV-{$year}-";
        $last = Invoice::where('number', 'like', $prefix . '%')
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
        $query = Invoice::with(['quotation.customer'])
            ->orderBy('id', 'desc')
            ->orderBy('date', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('number', 'like', '%' . $search . '%')
                  ->orWhereHas('quotation', function ($q2) use ($search) {
                      $q2->where('number', 'like', '%' . $search . '%')
                         ->orWhereHas('customer', function ($q3) use ($search) {
                             $q3->where('name', 'like', '%' . $search . '%');
                         });
                  });
            });
        }

        $invoices = $query->paginate(20)->appends($request->except('page'));
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $quotations = Quotation::whereIn('status', ['Approved', 'Fully Invoiced'])
            ->orderBy('id', 'desc')
            ->orderBy('date', 'desc')
            ->get();
        $invoice = new Invoice();
        $invoice->number = $this->generateNumber();
        return view('invoices.form', compact('invoice', 'quotations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'quotation_id' => 'required',
            'date' => 'required|date',
            'due_date' => 'required|date',
        ]);

        $quotation = Quotation::find($request->quotation_id);
        $quotationTotal = $quotation ? $quotation->total : 0;

        $data = $request->except(['_token', '_method']);
        $data['number'] = $this->generateNumber();
        $data['non_vat'] = $request->has('non_vat') ? 1 : 0;
        $data['total'] = $quotationTotal;
        $data['status'] = 'Belum Bayar';
        $data['paid_amount'] = 0;
        $data['created_by'] = auth()->id();
        
        $invoice = Invoice::create($data);
        Log::info(sprintf('[Invoice] %s membuat invoice %s dari quotation %s', auth()->user()?->fullname ?? 'system', $invoice->number, $invoice->quotation?->number ?? $invoice->quotation_id));

        return redirect()->route('invoices.index')->with('success', 'Tagihan / Invoice berhasil dibuat.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('quotation.customer', 'quotation.items.product', 'quotation.sales', 'payments.createdBy', 'createdBy', 'updatedBy');
        Log::info(sprintf('[Invoice] %s membuka/cetak invoice %s', auth()->user()?->fullname ?? 'system', $invoice->number));
        return view('invoices.print', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        if (!auth()->user()?->hasFullAccess()) {
            abort(403, 'Hanya owner dan admin yang dapat mengedit invoice.');
        }

        $invoice->load('createdBy', 'updatedBy');
        $quotations = Quotation::orderBy('id', 'desc')
            ->orderBy('date', 'desc')
            ->get();
        return view('invoices.form', compact('invoice', 'quotations'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        if (!auth()->user()?->hasFullAccess()) {
            abort(403, 'Hanya owner dan admin yang dapat mengubah invoice.');
        }

        $request->validate([
            'quotation_id' => 'required',
            'date' => 'required|date',
            'due_date' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        $data = $request->except(['_token', '_method', 'number']);
        $data['non_vat'] = $request->has('non_vat') ? 1 : 0;
        $data['updated_by'] = auth()->id();

        $quotation = Quotation::find($request->quotation_id);
        $data['total'] = $quotation ? $quotation->total : $invoice->total;

        $invoice->update($data);
        Log::info(sprintf('[Invoice] %s mengubah invoice %s (status=%s, total=%s)', auth()->user()?->fullname ?? 'system', $invoice->number, $invoice->status, $invoice->total));

        return redirect()->route('invoices.index')->with('success', 'Tagihan / Invoice berhasil diubah.');
    }

    public function destroy(Invoice $invoice)
    {
        if (!auth()->user()?->isOwner()) {
            abort(403, 'Hanya owner yang dapat menghapus invoice.');
        }

        // Pembayaran terkait akan dihapus karena ON DELETE CASCADE di database
        // Cashflow yang sumbernya dari payment juga harus dihapus,
        // Tapi kita hapus cashflow yang terkait dengan invoice ini jika ada yang manual
        Cashflow::where('invoice_id', $invoice->id)->delete();

        $invoiceNumber = $invoice->number;
        $invoice->delete();
        Log::info(sprintf('[Invoice] %s menghapus invoice %s', auth()->user()?->fullname ?? 'system', $invoiceNumber));
        return back()->with('success', 'Invoice berhasil dihapus.');
    }
}
