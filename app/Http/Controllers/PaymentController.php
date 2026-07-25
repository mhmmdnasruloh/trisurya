<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Cashflow;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display payment form for an invoice
     */
    public function create(Invoice $invoice)
    {
        // Check authorization
        if (!auth()->user()->hasFullAccess()) {
            abort(403, 'Anda tidak memiliki akses untuk membuat pembayaran');
        }

        return view('payments.create', compact('invoice'));
    }

    /**
     * Store a new payment record
     */
    public function store(Request $request, Invoice $invoice)
    {
        // Check authorization
        if (!auth()->user()->hasFullAccess()) {
            abort(403, 'Anda tidak memiliki akses untuk membuat pembayaran');
        }

        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'method' => 'nullable|string',
            'paid_at' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $validated['invoice_id'] = $invoice->id;
        $validated['created_by'] = auth()->id();

        // Create payment record
        $payment = Payment::create($validated);

        // Update invoice paid_amount and status
        $invoice->paid_amount += $payment->amount;
        $invoice->recalculateStatus();

        // Create cashflow entry for this payment (realized cash)
        Cashflow::create([
            'tanggal' => $payment->paid_at->toDateString(),
            'jenis' => 'Income', // masuk = income
            'nominal' => $payment->amount,
            'keterangan' => "Payment untuk Invoice #{$invoice->number}" . ($validated['note'] ? " - " . $validated['note'] : ''),
            'kategori' => 'Pembayaran Invoice',
            'sumber_dana' => 'Invoice',
            'source' => 'payment',
            'source_id' => $payment->id,
            'created_by' => auth()->id(),
            'invoice_id' => $invoice->id,
        ]);

        return redirect()
            ->route('invoices.show', $invoice->id)
            ->with('success', 'Pembayaran berhasil dicatat dan cashflow updated');
    }

    /**
     * Display all payments for an invoice
     */
    public function index(Invoice $invoice)
    {
        $payments = $invoice->payments()->get();
        return view('payments.index', compact('invoice', 'payments'));
    }

    /**
     * Delete a payment
     */
    public function destroy(Payment $payment)
    {
        // Check authorization
        if (!auth()->user()->hasFullAccess()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus pembayaran');
        }

        $invoice = $payment->invoice;

        // Revert cashflow entry
        Cashflow::where('source', 'payment')
            ->where('source_id', $payment->id)
            ->delete();

        // Update invoice paid_amount
        $invoice->paid_amount -= $payment->amount;
        $invoice->recalculateStatus();

        // Delete payment
        $payment->delete();

        return redirect()
            ->route('payments.index', $invoice->id)
            ->with('success', 'Pembayaran berhasil dihapus');
    }
}
