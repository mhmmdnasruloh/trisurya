<?php
namespace App\Http\Controllers;

use App\Models\DeliveryNote;
use App\Models\Invoice;
use Illuminate\Http\Request;

class DeliveryNoteController extends Controller
{
    private function generateNumber()
    {
        $year = date('Y');
        $prefix = "SJ-{$year}-";
        $last = DeliveryNote::where('number', 'like', $prefix . '%')
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
        $query = DeliveryNote::with(['invoice.quotation.customer'])
            ->orderBy('id', 'desc')
            ->orderBy('date', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $deliveryNotes = $query->paginate(20)->appends($request->except('page'));
        return view('delivery_notes.index', compact('deliveryNotes'));
    }

    public function create()
    {
        $invoices = Invoice::with('quotation.customer')
            ->orderBy('id', 'desc')
            ->orderBy('date', 'desc')
            ->get();
        $deliveryNote = new DeliveryNote();
        $deliveryNote->number = $this->generateNumber();
        return view('delivery_notes.form', compact('deliveryNote', 'invoices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required',
            'date' => 'required|date'
        ]);

        $data = $request->except(['_token', '_method']);
        $data['number'] = $this->generateNumber();
        
        DeliveryNote::create($data);
        return redirect()->route('delivery_notes.index')->with('success', 'Surat Jalan berhasil dibuat.');
    }

    public function show(DeliveryNote $deliveryNote)
    {
        $deliveryNote->load('invoice.quotation.customer', 'invoice.quotation.items.product');
        return view('delivery_notes.print', compact('deliveryNote'));
    }

    public function edit(DeliveryNote $deliveryNote)
    {
        $invoices = Invoice::with('quotation.customer')
            ->orderBy('id', 'desc')
            ->orderBy('date', 'desc')
            ->get();
        return view('delivery_notes.form', compact('deliveryNote', 'invoices'));
    }

    public function update(Request $request, DeliveryNote $deliveryNote)
    {
        $request->validate([
            'invoice_id' => 'required',
            'date' => 'required|date'
        ]);

        $data = $request->except(['_token', '_method', 'number']);

        $deliveryNote->update($data);
        return redirect()->route('delivery_notes.index')->with('success', 'Surat Jalan berhasil diupdate.');
    }

    public function destroy(DeliveryNote $deliveryNote)
    {
        $deliveryNote->delete();
        return back()->with('success', 'Surat Jalan berhasil dihapus.');
    }
}
