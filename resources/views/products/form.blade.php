@extends('layouts.app')
@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ isset($product) ? 'Edit Timbangan' : 'Tambah Timbangan' }}</h2>

    @if ($errors->any())
    <div class="bg-red-50 text-red-600 p-4 rounded mb-4">
        <ul class="list-disc pl-4">
            @foreach ($errors->all() as $err) <li>{{ $err }}</li> @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST" class="space-y-4">
        @csrf
        @if(isset($product)) @method('PUT') @endif

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium text-gray-700">Kode Timbangan*</label>
                <input type="text" name="code" value="{{ old('code', $product->code ?? '') }}" class="font-mono w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Nama Timbangan*</label>
                <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Harga Satuan*</label>
                <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Stok Awal*</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock ?? '0') }}" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200" required>
            </div>
            <div class="col-span-2">
                <label class="block font-medium text-gray-700">Keterangan / Deskripsi</label>
                <textarea name="description" rows="3" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200">{{ old('description', $product->description ?? '') }}</textarea>
            </div>
        </div>
        <div class="pt-4 flex justify-between space-x-4">
            <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-medium">Simpan Data</button>
        </div>
    </form>
</div>
@endsection
