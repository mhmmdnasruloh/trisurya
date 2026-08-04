@extends('layouts.app')
@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-4xl mx-auto mb-10">
    <div class="flex justify-between border-b pb-4 mb-6">
        <h2 class="text-2xl font-bold text-gray-800">{{ $deliveryNote->id ? 'Edit Surat Jalan' : 'Buat Surat Jalan Baru' }}</h2>
        <a href="{{ route('delivery_notes.index') }}" class="text-gray-500 hover:text-gray-700">Kembali</a>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 text-red-600 p-4 rounded mb-4">
        <ul class="list-disc pl-4">
            @foreach ($errors->all() as $err) <li>{{ $err }}</li> @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ $deliveryNote->id ? route('delivery_notes.update', $deliveryNote->id) : route('delivery_notes.store') }}" method="POST">
        @csrf
        @if($deliveryNote->id) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Nomor Surat Jalan</label>
                <input type="text" name="number" value="{{ old('number', $deliveryNote->number) }}" class="w-full border px-3 py-2 rounded font-mono font-bold bg-gray-100 text-gray-500 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Hubungkan Invoice (Tagihan)*</label>
                <select name="invoice_id" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-300" required>
                    <option value="">-- Pilih Tagihan Terkait --</option>
                    @foreach($invoices as $inv)
                    <option value="{{ $inv->id }}" {{ old('invoice_id', $deliveryNote->invoice_id) == $inv->id ? 'selected' : '' }}>{{ $inv->number }} - {{ $inv->quotation->customer->name ?? '' }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Tanggal Pengiriman*</label>
                <input type="date" name="date" value="{{ old('date', $deliveryNote->date) }}" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-300" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Status Pengiriman*</label>
                <select name="status" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-300" required>
                    <option value="In Transit" {{ old('status', $deliveryNote->status) == 'In Transit' ? 'selected' : '' }}>In Transit</option>
                    <option value="Delivered" {{ old('status', $deliveryNote->status) == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                </select>
            </div>
            <div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Nama Penerima (PIC)</label>
                <input type="text" name="pic_name" value="{{ old('pic_name', $deliveryNote->pic_name) }}" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-300">
            </div>
            <div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Telepon Penerima</label>
                <input type="text" name="pic_phone" value="{{ old('pic_phone', $deliveryNote->pic_phone) }}" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-300">
            </div>
            <div class="col-span-1 md:col-span-2">
                <div class="mb-3">
                    <label class="flex items-center">
                        <input type="checkbox" id="sameAddressCheckbox" class="form-checkbox text-blue-600 rounded" {{ old('use_customer_address', $deliveryNote->use_customer_address) ? 'checked' : '' }} onchange="toggleAddressField()">
                        <span class="ml-2 font-medium text-gray-700">Gunakan Alamat dari Profil Customer</span>
                    </label>
                </div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Alamat Pengiriman Spesifik</label>
                <textarea id="shippingAddressField" name="shipping_address" rows="3" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-300" placeholder="Masukkan alamat pengiriman spesifik">{{ old('shipping_address', $deliveryNote->shipping_address) }}</textarea>
            </div>
        </div>

        <script>
            // Map invoice_id to customer address
            const invoiceAddressMap = {
                @foreach($invoices as $inv) {
                    {
                        $inv - > id
                    }
                }: "{{ addslashes($inv->quotation->customer->address ?? '') }}"
                , @endforeach
            };

            function getSelectedCustomerAddress() {
                const invoiceSelect = document.querySelector('select[name="invoice_id"]');
                const selectedId = invoiceSelect ? invoiceSelect.value : '';
                return invoiceAddressMap[selectedId] || '';
            }

            function toggleAddressField() {
                const checkbox = document.getElementById('sameAddressCheckbox');
                const addressField = document.getElementById('shippingAddressField');
                const customerAddress = getSelectedCustomerAddress();

                if (checkbox.checked) {
                    addressField.value = customerAddress;
                    addressField.disabled = true;
                    addressField.removeAttribute('required');
                } else {
                    addressField.disabled = false;
                    addressField.setAttribute('required', 'required');
                }
            }

            // When invoice selection changes, update address if checkbox is checked
            document.querySelector('select[name="invoice_id"]').addEventListener('change', function() {
                const checkbox = document.getElementById('sameAddressCheckbox');
                if (checkbox.checked) {
                    toggleAddressField();
                }
            });

            // Initialize on page load
            document.addEventListener('DOMContentLoaded', toggleAddressField);

        </script>

        @if($deliveryNote->id)
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-5 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Riwayat Audit</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                <div>
                    <p class="font-medium text-gray-800">Dibuat</p>
                    <p>{{ $deliveryNote->created_at ? $deliveryNote->created_at->format('d M Y H:i') : '-' }}</p>
                    <p class="text-gray-600">oleh {{ $deliveryNote->createdBy->fullname ?? 'System' }}</p>
                </div>
                <div>
                    <p class="font-medium text-gray-800">Terakhir diperbarui</p>
                    <p>{{ $deliveryNote->updated_at ? $deliveryNote->updated_at->format('d M Y H:i') : '-' }}</p>
                    <p class="text-gray-600">oleh {{ $deliveryNote->updatedBy->fullname ?? ($deliveryNote->createdBy->fullname ?? 'System') }}</p>
                </div>
            </div>
        </div>
        @endif

        <div class="border-t pt-6 flex justify-end space-x-4">
            <a href="{{ route('delivery_notes.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded font-medium">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 rounded font-medium shadow">Simpan Surat Jalan</button>
        </div>
    </form>
</div>
@endsection
