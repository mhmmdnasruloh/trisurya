@extends('layouts.app')
@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ isset($customer) ? 'Edit Customer' : 'Tambah Customer' }}</h2>
    
    @if ($errors->any())
        <div class="bg-red-50 text-red-600 p-4 rounded mb-4">
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $err) <li>{{ $err }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($customer) ? route('customers.update', $customer->id) : route('customers.store') }}" method="POST" class="space-y-4">
        @csrf
        @if(isset($customer)) @method('PUT') @endif
        
        <div>
            <label class="block font-medium text-gray-700">Nama Perusahaan*</label>
            <input type="text" name="name" value="{{ old('name', $customer->name ?? '') }}" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200" required>
        </div>
        <div>
            <label class="block font-medium text-gray-700">Alamat</label>
            <textarea name="address" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200">{{ old('address', $customer->address ?? '') }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium text-gray-700">Telepon Perusahaan</label>
                <input type="text" name="phone" value="{{ old('phone', $customer->phone ?? '') }}" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Email Perusahaan</label>
                <input type="email" name="email" value="{{ old('email', $customer->email ?? '') }}" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Nama PIC</label>
                <input type="text" name="pic_name" value="{{ old('pic_name', $customer->pic_name ?? '') }}" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Telepon PIC</label>
                <input type="text" name="pic_phone" value="{{ old('pic_phone', $customer->pic_phone ?? '') }}" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200">
            </div>
            <div class="col-span-2">
                <label class="block font-medium text-gray-700">NPWP</label>
                <input type="text" name="npwp" value="{{ old('npwp', $customer->npwp ?? '') }}" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200">
            </div>
        </div>
        <div class="pt-4 flex justify-between space-x-4">
            <a href="{{ route('customers.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-medium">Simpan Data</button>
        </div>
    </form>
</div>
@endsection
