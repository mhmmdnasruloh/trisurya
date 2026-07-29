@extends('layouts.app')
@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Tagihan (Invoices)</h2>
        <a href="{{ route('invoices.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded shadow">
            + Tagihan Baru
        </a>
    </div>

    <form method="GET" class="flex items-center gap-2 mb-4">
        <label class="text-sm text-gray-600">Status:</label>
        <select name="status" class="border px-3 py-2 rounded">
            <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua</option>
            <option value="DP" {{ request('status') == 'DP' ? 'selected' : '' }}>DP</option>
            <option value="Lunas" {{ request('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
            <option value="Dibatalkan" {{ request('status') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
        </select>
        <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-2 rounded">Filter</button>
        <a href="{{ route('invoices.index') }}" class="text-sm text-gray-600 underline">Bersihkan</a>
    </form>

    @if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-50 border-b">
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">No Tagihan / Tanggal</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">No Penawaran (Quotation)</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Tanggal Jatuh Tempo</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Total & Pembayaran</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Status</th>
                    <th class="py-3 px-4 text-center font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $inv)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4">
                        <span class="font-mono font-bold text-blue-600">{{ $inv->number }}</span><br>
                        <span class="text-sm text-gray-500">{{ date('d M Y', strtotime($inv->date)) }}</span>
                    </td>
                    <td class="py-3 px-4 text-sm font-mono">{{ $inv->quotation->number ?? 'N/A' }} <br><span class="text-gray-500 font-sans font-medium">{{ $inv->quotation->customer->name ?? '' }}</span></td>
                    <td class="py-3 px-4 {{ strtotime($inv->due_date) < time() && strpos(strtolower($inv->status), 'belum') !== false ? 'text-red-600 font-bold' : '' }}">
                        {{ date('d M Y', strtotime($inv->due_date)) }}
                    </td>
                    <td class="py-3 px-4">
                        <div class="text-sm">
                            <div class="flex justify-between"><span class="text-gray-500">Total:</span> <span class="font-bold">Rp {{ number_format($inv->total, 0, ',', '.') }}</span></div>
                            <div class="flex justify-between"><span class="text-gray-500">Dibayar:</span> <span class="text-green-600">Rp {{ number_format($inv->paid_amount, 0, ',', '.') }}</span></div>
                            <div class="flex justify-between border-t mt-1 pt-1"><span class="text-gray-500">Sisa:</span> <span class="text-red-600 font-bold">Rp {{ number_format($inv->outstanding, 0, ',', '.') }}</span></div>
                        </div>
                    </td>
                    <td class="py-3 px-4">
                        @php
                        $sts = strtolower(trim($inv->status));
                        if (strpos($sts, 'lunas') !== false) {
                        $color = 'bg-green-100 text-green-800';
                        } elseif ($sts == 'dp') {
                        $color = 'bg-blue-100 text-blue-800';
                        } elseif ($sts == 'dibatalkan') {
                        $color = 'bg-gray-100 text-gray-800';
                        } else {
                        $color = 'bg-red-100 text-red-800';
                        }
                        @endphp
                        <span class="px-2 py-1 text-xs rounded font-bold {{ $color }}">{{ $inv->status }}</span>
                    </td>
                    <td class="py-3 px-4 text-center space-x-2">
                        <a href="{{ route('invoices.show', $inv->id) }}" target="_blank" class="text-green-600 hover:underline font-medium block sm:inline">Cetak</a>
                        <a href="{{ route('payments.index', $inv->id) }}" class="text-indigo-600 hover:underline font-medium block sm:inline">Riwayat Bayar</a>

                        @if(auth()->user()->hasFullAccess())
                        @if(strtolower($inv->status) !== 'lunas' && strtolower($inv->status) !== 'dibatalkan')
                        <a href="{{ route('payments.create', $inv->id) }}" class="text-blue-600 hover:underline font-medium block sm:inline whitespace-nowrap">Catat Bayar</a>
                        @endif
                        @endif

                        @if(auth()->user()->hasFullAccess())
                        <a href="{{ route('invoices.edit', $inv->id) }}" class="text-blue-600 hover:underline block sm:inline">Edit</a>
                        @endif

                        @if(auth()->user()->isOwner())
                        <form action="{{ route('invoices.destroy', $inv->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline" onclick="return confirm('Hapus invoice ini?')">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $invoices->links() }}</div>
</div>
@endsection
