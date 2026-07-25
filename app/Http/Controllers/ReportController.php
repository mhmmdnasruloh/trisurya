<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Quotation;
use App\Models\DeliveryNote;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Show report filter page
     */
    public function index()
    {
        // Check authorization
        if (auth()->user()->role === 'admin') {
            abort(403, 'Admin tidak dapat mengakses laporan');
        }

        $currentYear = now()->year;
        $years = range($currentYear - 5, $currentYear);

        return view('reports.index', compact('years'));
    }

    /**
     * Export invoices to CSV/Excel
     */
    public function exportInvoices(Request $request)
    {
        // Check authorization
        if (!auth()->user()->hasFullAccess()) {
            abort(403, 'Anda tidak memiliki akses untuk export laporan');
        }

        $validated = $request->validate([
            'year' => 'nullable|integer|min:1900',
            'month' => 'nullable|integer|min:1|max:12',
        ]);

        $fileName = 'Laporan-Invoice-' . now()->format('d-m-Y-His') . '.xlsx';
        
        $query = Invoice::query();
        if (!empty($validated['year'])) $query->whereYear('date', $validated['year']);
        if (!empty($validated['month'])) $query->whereMonth('date', $validated['month']);

        return (new \Rap2hpoutre\FastExcel\FastExcel($query->get()))->download($fileName, function ($invoice) {
            return [
                'Nomor Tagihan' => $invoice->number,
                'Pelanggan' => $invoice->quotation->customer->name ?? '-',
                'Total Tagihan' => 'Rp ' . number_format($invoice->total, 0, ',', '.'),
                'Total Dibayar' => 'Rp ' . number_format($invoice->paid_amount ?? 0, 0, ',', '.'),
                'Sisa Tagihan (Piutang)' => 'Rp ' . number_format(($invoice->outstanding ?? 0), 0, ',', '.'),
                'Status' => $invoice->status ?? 'Belum Bayar',
                'Tanggal' => $invoice->date ? date('d-m-Y', strtotime($invoice->date)) : '-',
                'Jatuh Tempo' => $invoice->due_date ? date('d-m-Y', strtotime($invoice->due_date)) : '-',
            ];
        });
    }

    /**
     * Export quotations to CSV/Excel
     */
    public function exportQuotations(Request $request)
    {
        // Check authorization
        if (!auth()->user()->hasFullAccess()) {
            abort(403, 'Anda tidak memiliki akses untuk export laporan');
        }

        $validated = $request->validate([
            'year' => 'nullable|integer|min:1900',
            'month' => 'nullable|integer|min:1|max:12',
        ]);

        $fileName = 'Laporan-Penawaran-' . now()->format('d-m-Y-His') . '.xlsx';
        
        $query = Quotation::with(['customer', 'sales']);
        if (!empty($validated['year'])) $query->whereYear('date', $validated['year']);
        if (!empty($validated['month'])) $query->whereMonth('date', $validated['month']);

        return (new \Rap2hpoutre\FastExcel\FastExcel($query->get()))->download($fileName, function ($quotation) {
            return [
                'Nomor Penawaran' => $quotation->number,
                'Pelanggan' => $quotation->customer->name ?? '-',
                'Sales' => $quotation->sales->fullname ?? '-',
                'Total Nominal' => 'Rp ' . number_format($quotation->total, 0, ',', '.'),
                'Status' => $quotation->status ?? 'Draft',
                'Tanggal Penawaran' => $quotation->date ? date('d-m-Y', strtotime($quotation->date)) : '-',
                'Tanggal Disetujui' => $quotation->approved_date ? date('d-m-Y', strtotime($quotation->approved_date)) : '-',
                'Tanggal Closed' => $quotation->closed_date ? date('d-m-Y', strtotime($quotation->closed_date)) : '-',
            ];
        });
    }

    /**
     * Export deliveries to CSV/Excel
     */
    public function exportDeliveries(Request $request)
    {
        // Check authorization
        if (!auth()->user()->hasFullAccess()) {
            abort(403, 'Anda tidak memiliki akses untuk export laporan');
        }

        $validated = $request->validate([
            'year' => 'nullable|integer|min:1900',
            'month' => 'nullable|integer|min:1|max:12',
        ]);

        $fileName = 'Laporan-Pengiriman-' . now()->format('d-m-Y-His') . '.xlsx';
        
        $query = DeliveryNote::query();
        if (!empty($validated['year'])) $query->whereYear('delivery_date', $validated['year']);
        if (!empty($validated['month'])) $query->whereMonth('delivery_date', $validated['month']);

        return (new \Rap2hpoutre\FastExcel\FastExcel($query->get()))->download($fileName, function ($delivery) {
            return [
                'Nomor Surat Jalan' => $delivery->number ?? $delivery->id,
                'Pelanggan' => $delivery->invoice->quotation->customer->name ?? '-',
                'Alamat Pengiriman' => $delivery->address_specific ?? $delivery->invoice->quotation->customer->address ?? '-',
                'Status' => $delivery->status ?? 'Draft',
                'Tanggal Pengiriman' => $delivery->delivery_date ? date('d-m-Y', strtotime($delivery->delivery_date)) : '-',
                'Nomor Kendaraan' => $delivery->vehicle_number ?? '-',
                'Nama Driver' => $delivery->driver_name ?? '-',
            ];
        });
    }
}
