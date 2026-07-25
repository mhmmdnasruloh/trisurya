@extends('layouts.app')
@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Master Data Customers</h2>
        <a href="{{ route('customers.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded shadow">
            + Tambah Customer
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-50 border-b">
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Nama Perusahaan</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">PIC</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Kontak</th>
                    <th class="py-3 px-4 text-center font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $c)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4">
                        <div class="font-bold">{{ $c->name }}</div>
                        <div class="text-sm text-gray-500">{{ $c->address }}</div>
                    </td>
                    <td class="py-3 px-4">{{ $c->pic_name }}</td>
                    <td class="py-3 px-4">
                        📞 {{ $c->phone }}<br>✉ {{ $c->email }}
                    </td>
                    <td class="py-3 px-4 text-center space-x-2">
                        <a href="{{ route('customers.edit', $c->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('customers.destroy', $c->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline" onclick="return confirm('Hapus data?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $customers->links() }}</div>
</div>
@endsection
