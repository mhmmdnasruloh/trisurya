@extends('layouts.app')
@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-4xl mx-auto mb-10">
    <div class="flex justify-between border-b pb-4 mb-6">
        <h2 class="text-2xl font-bold text-gray-800">{{ $invoice->id ? 'Edit Tagihan' : 'Buat Tagihan Baru' }}</h2>
        <a href="{{ route('invoices.index') }}" class="text-gray-500 hover:text-gray-700">Kembali</a>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 text-red-600 p-4 rounded mb-4">
        <ul class="list-disc pl-4">
            @foreach ($errors->all() as $err) <li>{{ $err }}</li> @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ $invoice->id ? route('invoices.update', $invoice->id) : route('invoices.store') }}" method="POST">
        @csrf
        @if($invoice->id) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Nomor Invoice</label>
                <input type="text" name="number" value="{{ old('number', $invoice->number) }}" class="w-full border px-3 py-2 rounded font-mono font-bold bg-gray-100 text-gray-500 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Pilih Quotation (Penawaran) Terkait*</label>
                <select name="quotation_id" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-300" required>
                    <option value="">-- Hubungkan dengan Penawaran --</option>
                    @foreach($quotations as $q)
                    <option value="{{ $q->id }}" {{ old('quotation_id', $invoice->quotation_id) == $q->id ? 'selected' : '' }}>{{ $q->number }} - {{ $q->customer->name ?? '' }} ({{ $q->status }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Tanggal Cetak Invoice*</label>
                <input type="date" name="date" id="invoiceDate" value="{{ old('date', $invoice->date ?? now()->format('Y-m-d')) }}" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-300" required onchange="updateDueDate()">
            </div>
            <div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Tanggal Jatuh Tempo (Due Date)*</label>
                <input type="date" name="due_date" id="invoiceDueDate" value="{{ old('due_date', $invoice->due_date ?? now()->addDays(30)->format('Y-m-d')) }}" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-300" required>
            </div>
            <div class="col-span-1 md:col-span-2">
                <label class="block font-medium text-gray-700 text-sm mb-1">Catatan Tagihan (Notes)</label>
                <textarea name="notes" rows="4" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-300">{{ old('notes', $invoice->notes) }}</textarea>
            </div>
        </div>

        @if($invoice->id)
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-5 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Riwayat Audit</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                <div>
                    <p class="font-medium text-gray-800">Dibuat</p>
                    <p>{{ $invoice->created_at ? $invoice->created_at->format('d M Y H:i') : '-' }}</p>
                    <p class="text-gray-600">oleh {{ $invoice->createdBy->fullname ?? 'System' }}</p>
                </div>
                <div>
                    <p class="font-medium text-gray-800">Terakhir diperbarui</p>
                    <p>{{ $invoice->updated_at ? $invoice->updated_at->format('d M Y H:i') : '-' }}</p>
                    <p class="text-gray-600">oleh {{ $invoice->updatedBy->fullname ?? ($invoice->createdBy->fullname ?? 'System') }}</p>
                </div>
            </div>
        </div>
        @endif

        <div class="border-t pt-6 flex justify-end space-x-4">
            <a href="{{ route('invoices.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded font-medium">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 rounded font-medium shadow">Simpan Invoice</button>
        </div>
    </form>
</div>

<script>
    function updateDueDate() {
        const dateInput = document.getElementById('invoiceDate').value;
        if (dateInput) {
            const date = new Date(dateInput);
            date.setDate(date.getDate() + 30);
            const yyyy = date.getFullYear();
            const mm = String(date.getMonth() + 1).padStart(2, '0');
            const dd = String(date.getDate()).padStart(2, '0');
            document.getElementById('invoiceDueDate').value = `${yyyy}-${mm}-${dd}`;
        }
    }

</script>

@endsection
