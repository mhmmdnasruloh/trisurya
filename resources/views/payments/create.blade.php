@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Catat Pembayaran</h2>
        <span class="text-gray-500 font-mono">Invoice #{{ $invoice->number }}</span>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 text-red-600 p-4 rounded mb-4">
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $err) <li>{{ $err }}</li> @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 mb-6">
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-gray-500">Customer</p>
                <p class="font-semibold text-gray-800">{{ $invoice->quotation->customer->name ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500">Status Invoice</p>
                <p class="font-bold {{ strtolower($invoice->status) == 'lunas' ? 'text-green-600' : 'text-blue-600' }}">{{ $invoice->status }}</p>
            </div>
            <div>
                <p class="text-gray-500">Total Tagihan</p>
                <p class="font-bold text-gray-800">Rp {{ number_format($invoice->total, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-gray-500">Sudah Dibayar</p>
                <p class="font-semibold text-green-600">Rp {{ number_format($invoice->paid_amount ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="col-span-2 pt-2 border-t border-blue-200">
                <p class="text-gray-600 font-medium">Sisa Pembayaran (Maksimal)</p>
                <p class="font-bold text-xl text-red-600">Rp {{ number_format($invoice->outstanding, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <form action="{{ route('payments.store', $invoice->id) }}" method="POST" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Jumlah Pembayaran (Rp)*</label>
                <input type="number" name="amount" step="1" min="1" max="{{ $invoice->outstanding }}" value="{{ old('amount', $invoice->outstanding) }}" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200 font-mono" required>
                <p class="text-xs text-gray-500 mt-1">Maks: Rp {{ number_format($invoice->outstanding, 0, ',', '.') }}</p>
            </div>

            <div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Metode Pembayaran</label>
                <select name="method" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200" required>
                    <option value="Transfer Bank" {{ old('method') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                    <option value="Cash" {{ old('method') == 'Cash' ? 'selected' : '' }}>Cash</option>
                </select>
            </div>

            <div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Tanggal Pembayaran*</label>
                <input type="datetime-local" name="paid_at" value="{{ old('paid_at', now()->format('Y-m-d\TH:i')) }}" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200" required>
            </div>
        </div>

        <div>
            <label class="block font-medium text-gray-700 text-sm mb-1">Catatan</label>
            <textarea name="note" rows="3" class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-200" placeholder="Opsional...">{{ old('note') }}</textarea>
        </div>

        <div class="pt-4 flex justify-between space-x-4 border-t">
            <a href="{{ route('invoices.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition-colors">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-medium shadow-md transition-colors">Simpan Pembayaran</button>
        </div>
    </form>
</div>
@endsection
