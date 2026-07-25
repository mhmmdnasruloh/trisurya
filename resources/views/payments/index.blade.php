@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Pembayaran</h2>
        <span class="text-gray-500 font-mono">Invoice #{{ $invoice->number }}</span>
    </div>

    <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 mb-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
            <div>
                <p class="text-gray-500">Customer</p>
                <p class="font-semibold text-gray-800">{{ $invoice->quotation->customer->name ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500">Total Tagihan</p>
                <p class="font-bold text-gray-800">Rp {{ number_format($invoice->total, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-gray-500">Sudah Dibayar</p>
                <p class="font-semibold text-green-600">Rp {{ number_format($invoice->paid_amount ?? 0, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-gray-500">Sisa Pembayaran</p>
                <p class="font-bold text-red-600">Rp {{ number_format($invoice->outstanding, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    @if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if($payments->count() > 0)
    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50 border-b text-gray-600 font-medium text-sm text-left">
                <tr>
                    <th class="py-3 px-4">Tanggal Pembayaran</th>
                    <th class="py-3 px-4">Metode</th>
                    <th class="py-3 px-4 text-right">Jumlah</th>
                    <th class="py-3 px-4">Catatan</th>
                    <th class="py-3 px-4">Dicatat Oleh</th>
                    @if(auth()->user()->hasFullAccess())
                    <th class="py-3 px-4 text-center">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($payments as $payment)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4">{{ $payment->paid_at->format('d M Y H:i') }}</td>
                    <td class="py-3 px-4">{{ $payment->method ?? '-' }}</td>
                    <td class="py-3 px-4 text-right font-medium text-green-600">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $payment->note ?? '-' }}</td>
                    <td class="py-3 px-4">{{ $payment->createdBy->fullname ?? '-' }}</td>
                    @if(auth()->user()->hasFullAccess())
                    <td class="py-3 px-4 text-center">
                        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 hover:underline" onclick="return confirm('Yakin ingin menghapus pembayaran ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="bg-gray-50 text-gray-500 p-8 rounded-lg text-center border border-gray-200 border-dashed">
        Belum ada riwayat pembayaran untuk invoice ini.
    </div>
    @endif

    <div class="mt-6 flex gap-4">
        <a href="{{ route('invoices.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-6 rounded-lg transition-colors">Kembali</a>
        @if(auth()->user()->hasFullAccess() && $invoice->outstanding > 0)
        <a href="{{ route('payments.create', $invoice->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg shadow transition-colors">
            + Catat Pembayaran
        </a>
        @endif
    </div>
</div>
@endsection
