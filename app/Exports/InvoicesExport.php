<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InvoicesExport implements FromCollection, WithHeadings, WithStyles
{
    protected $year;
    protected $month;

    public function __construct($year = null, $month = null)
    {
        $this->year = $year;
        $this->month = $month;
    }

    public function collection()
    {
        $query = Invoice::query();

        if ($this->year) {
            $query->whereYear('date', $this->year);
        }

        if ($this->month) {
            $query->whereMonth('date', $this->month);
        }

        return $query->get()->map(function ($invoice) {
            return [
                'ID' => $invoice->number,
                'Customer' => $invoice->quotation->customer->name ?? '-',
                'Total Price' => 'Rp ' . number_format($invoice->total, 0, ',', '.'),
                'Paid Amount' => 'Rp ' . number_format($invoice->paid_amount ?? 0, 0, ',', '.'),
                'Outstanding' => 'Rp ' . number_format(($invoice->outstanding ?? 0), 0, ',', '.'),
                'Status' => $invoice->status ?? 'Belum Bayar',
                'Tanggal' => $invoice->date ? date('d-m-Y', strtotime($invoice->date)) : '-',
                'Jatuh Tempo' => $invoice->due_date ? date('d-m-Y', strtotime($invoice->due_date)) : '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nomor Tagihan',
            'Pelanggan',
            'Total Tagihan',
            'Total Dibayar',
            'Sisa Tagihan (Piutang)',
            'Status',
            'Tanggal',
            'Jatuh Tempo',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FFD9E1F2']]],
        ];
    }
}
