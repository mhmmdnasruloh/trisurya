<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Quotation;
use App\Models\Cashflow;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        
        Invoice::create($data);

        return redirect()->route('invoices.index')->with('success', 'Tagihan / Invoice berhasil dibuat.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('quotation.customer', 'quotation.items.product', 'quotation.sales', 'payments.createdBy');
        return view('invoices.print', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        if (!auth()->user()?->hasFullAccess()) {
            abort(403, 'Hanya owner dan admin yang dapat mengedit invoice.');
        }

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

        $quotation = Quotation::find($request->quotation_id);
        $data['total'] = $quotation ? $quotation->total : $invoice->total;

        $invoice->update($data);

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

        $invoice->delete();
        return back()->with('success', 'Invoice berhasil dihapus.');
    }
}
