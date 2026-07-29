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
            $query->whereYear('date', $this->year);
        }

        if ($this->month) {
            $query->whereMonth('date', $this->month);
        }

        return $query->get()->map(function ($delivery) {
            $customer = $delivery->invoice?->quotation?->customer;

            return [
                'ID' => $delivery->number ?? $delivery->id,
                'Customer' => $customer?->name ?? '-',
                'Address' => $delivery->shipping_address ?? $customer?->address ?? '-',
                'Status' => $delivery->status ?? 'Draft',
                'Delivery Date' => $delivery->date ? date('d-m-Y', strtotime($delivery->date)) : '-',
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
