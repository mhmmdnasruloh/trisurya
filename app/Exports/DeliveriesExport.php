<?php

namespace App\Exports;

use App\Models\DeliveryNote;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DeliveriesExport implements FromCollection, WithHeadings, WithStyles
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
        $query = DeliveryNote::query();

        if ($this->year) {
            $query->whereYear('delivery_date', $this->year);
        }

        if ($this->month) {
            $query->whereMonth('delivery_date', $this->month);
        }

        return $query->get()->map(function ($delivery) {
            return [
                'ID' => $delivery->number ?? $delivery->id,
                'Customer' => $delivery->invoice->quotation->customer->name ?? '-',
                'Address' => $delivery->address_specific ?? $delivery->invoice->quotation->customer->address ?? '-',
                'Status' => $delivery->status ?? 'Draft',
                'Delivery Date' => $delivery->delivery_date ? date('d-m-Y', strtotime($delivery->delivery_date)) : '-',
                'Nomor Kendaraan' => $delivery->vehicle_number ?? '-',
                'Nama Driver' => $delivery->driver_name ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nomor Surat Jalan',
            'Pelanggan',
            'Alamat Pengiriman',
            'Status',
            'Tanggal Pengiriman',
            'Nomor Kendaraan',
            'Nama Driver',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'FFF4B084']]],
        ];
    }
}
