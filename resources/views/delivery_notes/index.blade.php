@extends('layouts.app')
@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Surat Jalan (Delivery Notes)</h2>
        <a href="{{ route('delivery_notes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded shadow">
            + Surat Jalan Baru
        </a>
    </div>

    <form method="GET" class="flex items-center gap-2 mb-4">
        <label class="text-sm text-gray-600">Status:</label>
        <select name="status" class="border px-3 py-2 rounded">
            <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua</option>
            <option value="In Transit" {{ request('status') == 'In Transit' ? 'selected' : '' }}>In Transit</option>
            <option value="Delivered" {{ request('status') == 'Delivered' ? 'selected' : '' }}>Delivered</option>
        </select>
        <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-2 rounded">Filter</button>
        <a href="{{ route('delivery_notes.index') }}" class="text-sm text-gray-600 underline">Bersihkan</a>
    </form>

    @if (session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-50 border-b">
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Surat Jalan / Tanggal</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Invoice & Customer</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Penerima (PIC)</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Status</th>
                    <th class="py-3 px-4 text-center font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deliveryNotes as $dn)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4">
                        <span class="font-bold text-blue-600">{{ $dn->number }}</span><br>
                        <span class="text-sm text-gray-500">{{ date('d M Y', strtotime($dn->date)) }}</span>
                    </td>
                    <td class="py-3 px-4">
                        <span class="font-mono text-sm">{{ $dn->invoice->number ?? 'N/A' }}</span><br>
                        <span class="font-medium text-gray-800">{{ $dn->invoice->quotation->customer->name ?? '' }}</span>
                    </td>
                    <td class="py-3 px-4">{{ $dn->pic_name ?? '-' }}<br><span class="text-xs">{{ $dn->pic_phone }}</span></td>
                    <td class="py-3 px-4">
                        <span class="px-2 py-1 text-xs rounded font-bold {{ strtolower($dn->status) === 'delivered' ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800' }}">{{ $dn->status }}</span>
                    </td>
                    <td class="py-3 px-4 text-center space-x-2">
                        <a href="{{ route('delivery_notes.show', $dn->id) }}" target="_blank" class="text-green-600 hover:underline font-medium">Cetak</a>
                        @if(auth()->user()->hasFullAccess())
                        <a href="{{ route('delivery_notes.edit', $dn->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        @endif

                        @if(auth()->user()->isOwner())
                        <form action="{{ route('delivery_notes.destroy', $dn->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline" onclick="return confirm('Hapus surat jalan ini?')">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $deliveryNotes->links() }}</div>
</div>
@endsection
