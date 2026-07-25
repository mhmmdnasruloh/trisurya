@extends('layouts.app')
@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Master Data Timbangan</h2>
            <p class="text-sm text-gray-500 mt-1">Unduh report Excel untuk data timbangan industri.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('products.export') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded shadow">
                Download Excel
            </a>
            <a href="{{ route('products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded shadow">
                + Tambah Timbangan
            </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-50 border-b">
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Kode</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Nama Timbangan</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Harga</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Stok</th>
                    <th class="py-3 px-4 text-center font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4 font-mono text-sm bg-gray-100 rounded my-2 block w-max">{{ $p->code }}</td>
                    <td class="py-3 px-4 font-medium">{{ $p->name }}<br><span class="text-xs text-gray-500">{{ Str::limit($p->description, 50) }}</span></td>
                    <td class="py-3 px-4">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                    <td class="py-3 px-4 font-bold {{ $p->stock < 5 ? 'text-red-500' : 'text-green-600' }}">{{ $p->stock }}</td>
                    <td class="py-3 px-4 text-center space-x-2">
                        <a href="{{ route('products.edit', $p->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('products.destroy', $p->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline" onclick="return confirm('Hapus data?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $products->links() }}</div>
</div>
@endsection
