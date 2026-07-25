<?php

namespace App\Exports;

use App\Models\Quotation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class QuotationsExport implements FromCollection, WithHeadings, WithStyles
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
        $query = Quotation::query();

        if ($this->year) {
            $query->whereYear('date', $this->year);
        }

        if ($this->month) {
            $query->whereMonth('date', $this->month);
        }

        return $query->get()->map(function ($quotation) {
            return [
                'ID' => $quotation->number,
                'Customer' => $quotation->customer->name ?? '-',
                'Sales' => $quotation->sales->fullname ?? '-',
                'Total Amount' => 'Rp ' . number_format($quotation->total, 0, ',', '.'),
                'Status' => $quotation->status ?? 'Draft',
                'Tanggal Penawaran' => $quotation->date ? date('d-m-Y', strtotime($quotation->date)) : '-',
                'Tanggal Disetujui' => $quotation->approved_date ? date('d-m-Y', strtotime($quotation->approved_date)) : '-',
                'Tanggal Closed' => $quotation->closed_date ? date('d-m-Y', strtotime($quotation->closed_date)) : '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nomor Penawaran',
            'Pelanggan',
            'Sales',
            'Total Nominal',
            'Status',
            'Tanggal Penawaran',
            'Tanggal Disetujui',
            'Tanggal Closed',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FFE2EFDA']]],
        ];
    }
}
