@extends('layouts.app')
@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Quotations (Penawaran)</h2>
        <a href="{{ route('quotations.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded shadow">
            + Penawaran Baru
        </a>
    </div>

    <form method="GET" class="flex items-center gap-2 mb-4">
        <label class="text-sm text-gray-600">Status:</label>
        <select name="status" class="border px-3 py-2 rounded">
            <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua</option>
            <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
            <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
            <option value="Closed" {{ request('status') == 'Closed' ? 'selected' : '' }}>Closed</option>
        </select>
        <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-2 rounded">Filter</button>
        <a href="{{ route('quotations.index') }}" class="text-sm text-gray-600 underline">Bersihkan</a>
    </form>

    @if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-50 border-b">
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Nomor</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Tgl Dibuat</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Tgl Approved</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Tgl Closed</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Customer</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Sales</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Total Harga</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Status</th>
                    <th class="py-3 px-4 text-center font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotations as $q)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4">
                        <span class="font-mono font-bold text-blue-600">{{ $q->number }}</span>
                    </td>
                    <td class="py-3 px-4 text-sm">{{ date('d M Y', strtotime($q->date)) }}</td>
                    <td class="py-3 px-4 text-sm">{{ $q->approved_date ? date('d M Y', strtotime($q->approved_date)) : '-' }}</td>
                    <td class="py-3 px-4 text-sm">{{ $q->closed_date ? date('d M Y', strtotime($q->closed_date)) : '-' }}</td>
                    <td class="py-3 px-4">{{ $q->customer->name ?? 'Unknown' }}</td>
                    <td class="py-3 px-4">{{ $q->sales->fullname ?? 'Unknown' }}</td>
                    <td class="py-3 px-4 font-bold">Rp {{ number_format($q->total, 0, ',', '.') }}</td>
                    <td class="py-3 px-4">
                        @php
                        $sts = strtoupper(trim($q->status));
                        $color = $sts == 'APPROVED' ? 'bg-green-100 text-green-800' : ($sts == 'CLOSED' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800');
                        @endphp
                        <span class="px-2 py-1 text-xs rounded font-bold {{ $color }}">{{ $q->status }}</span>
                    </td>
                    <td class="py-3 px-4 text-center space-x-2">
                        <a href="{{ route('quotations.show', $q->id) }}" target="_blank" class="text-green-600 hover:underline font-medium">Cetak</a>
                        @if(auth()->user()->hasFullAccess())
                        <a href="{{ route('quotations.edit', $q->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        @endif

                        @if(auth()->user()->isOwner() || auth()->user()->isAdmin())
                        <form action="{{ route('quotations.destroy', $q->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline" onclick="return confirm('Hapus penawaran ini?')">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $quotations->links() }}</div>
</div>
@endsection
