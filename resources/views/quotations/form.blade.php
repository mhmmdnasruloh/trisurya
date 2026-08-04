@extends('layouts.app')
@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-6xl mx-auto mb-10">
    <div class="flex justify-between border-b pb-4 mb-6">
        <h2 class="text-2xl font-bold text-gray-800">{{ $quotation->id ? 'Edit Penawaran' : 'Buat Penawaran Baru' }}</h2>
        <a href="{{ route('quotations.index') }}" class="text-gray-500 hover:text-gray-700">Kembali</a>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 text-red-600 p-4 rounded mb-4">
        <ul class="list-disc pl-4">
            @foreach ($errors->all() as $err) <li>{{ $err }}</li> @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ $quotation->id ? route('quotations.update', $quotation->id) : route('quotations.store') }}" method="POST" id="quotationForm">
        @csrf
        @if($quotation->id) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 bg-gray-50 p-6 rounded border border-gray-200">
            <div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Nomor Quotation</label>
                <input type="text" name="number" value="{{ old('number', $quotation->number) }}" class="w-full border px-3 py-2 rounded outline-none font-mono font-bold bg-gray-100 text-gray-500 cursor-not-allowed" readonly>
            </div>
            <div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Tanggal Penawaran*</label>
                <input type="date" name="date" value="{{ old('date', $quotation->date) }}" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-300 outline-none bg-white" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Status Penawaran*</label>
                <select id="statusInput" name="status" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-300 outline-none bg-white" required>
                    <option value="Open" {{ old('status', $quotation->status) == 'Open' ? 'selected' : '' }}>Open</option>
                    <option value="Approved" {{ old('status', $quotation->status) == 'Approved' ? 'selected' : '' }}>Approved</option>
                    <option value="Closed" {{ old('status', $quotation->status) == 'Closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>
            <div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Pilih Customer*</label>
                <select name="customer_id" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-300 outline-none bg-white" required>
                    <option value="">-- Pilih Customer --</option>
                    @foreach($customers as $c)
                    <option value="{{ $c->id }}" {{ old('customer_id', $quotation->customer_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Pilih Sales*</label>
                <select name="sales_id" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-300 outline-none bg-white" required>
                    <option value="">-- Pilih Sales --</option>
                    @foreach($sales as $s)
                    <option value="{{ $s->id }}" {{ old('sales_id', $quotation->sales_id) == $s->id ? 'selected' : '' }}>{{ $s->fullname }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-medium text-gray-700 text-sm mb-1">Termin Pembayaran</label>
                <input type="text" name="payment_term" value="{{ old('payment_term', $quotation->payment_term ?? '30 Hari') }}" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-300 outline-none bg-white" placeholder="Contoh: 30 Hari">
            </div>
            <div class="col-span-1 md:col-span-3 flex flex-wrap gap-4">
                <div>
                    <label class="block font-medium text-gray-700 text-sm mb-1">Tanggal Approved</label>
                    <input id="approvedDateInput" type="date" name="approved_date" value="{{ old('approved_date', $quotation->approved_date) }}" class="w-64 border px-3 py-2 rounded focus:ring-2 focus:ring-blue-300 outline-none bg-white" {{ old('status', $quotation->status) !== 'Approved' ? 'disabled' : '' }}>
                </div>
                <div>
                    <label class="block font-medium text-gray-700 text-sm mb-1">Tanggal Closed</label>
                    <input id="closedDateInput" type="date" name="closed_date" value="{{ old('closed_date', $quotation->closed_date) }}" class="w-64 border px-3 py-2 rounded focus:ring-2 focus:ring-blue-300 outline-none bg-white" {{ old('status', $quotation->status) !== 'Closed' ? 'disabled' : '' }}>
                </div>
            </div>
        </div>

        <!-- ITEMS -->
        <h3 class="text-lg font-bold text-gray-800 mb-3 border-b-2 border-blue-500 inline-block pb-1">Daftar Barang yang Ditawarkan</h3>
        <div class="overflow-x-auto mb-4 border border-gray-300 rounded shadow-sm">
            <table class="w-full text-left bg-white" id="itemsTable">
                <thead class="bg-gray-100 border-b border-gray-300 text-sm">
                    <tr>
                        <th class="p-3 w-1/3">Produk</th>
                        <th class="p-3 w-24">Qty</th>
                        <th class="p-3 w-1/5">Harga Satuan (Rp)</th>
                        <th class="p-3 w-24">Disc (%)</th>
                        <th class="p-3 w-1/5 text-right">Subtotal</th>
                        <th class="p-3 w-16 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="itemsBody" class="text-sm">
                    <!-- Dynamic Rows Populated by JS -->
                </tbody>
            </table>
        </div>

        <div class="flex justify-between items-center mb-10 bg-gray-50 p-4 border rounded">
            <button type="button" id="addRowBtn" class="bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-2 rounded-full font-medium shadow transition-colors">+ Tambah Baris Produk</button>
            <div class="text-right">
                <p class="text-gray-500 font-medium text-sm">Grand Total Penawaran</p>
                <p class="text-4xl font-bold text-blue-700 tracking-tight">Rp <span id="grandTotalLabel">0</span></p>
            </div>
        </div>

        @if($quotation->id)
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-5 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Riwayat Audit</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                <div>
                    <p class="font-medium text-gray-800">Dibuat</p>
                    <p>{{ $quotation->created_at ? $quotation->created_at->format('d M Y H:i') : '-' }}</p>
                    <p class="text-gray-600">oleh {{ $quotation->createdBy->fullname ?? 'System' }}</p>
                </div>
                <div>
                    <p class="font-medium text-gray-800">Terakhir diperbarui</p>
                    <p>{{ $quotation->updated_at ? $quotation->updated_at->format('d M Y H:i') : '-' }}</p>
                    <p class="text-gray-600">oleh {{ $quotation->updatedBy->fullname ?? ($quotation->createdBy->fullname ?? 'System') }}</p>
                </div>
            </div>
        </div>

        @if(isset($statusHistories) && $statusHistories->count())
        <div class="bg-white border border-gray-200 rounded-lg p-5 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Riwayat Perubahan Status</h3>
            <div class="space-y-3 text-sm text-gray-700">
                @foreach($statusHistories as $history)
                <div class="border border-gray-200 rounded-lg p-3 bg-gray-50">
                    <p class="font-medium text-gray-800">{{ $history->old_status ?? '—' }} → {{ $history->new_status }}</p>
                    <p class="text-gray-600">{{ $history->created_at->format('d M Y H:i') }} oleh {{ $history->user->fullname ?? 'System' }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @endif

        <div class="border-t pt-6 flex justify-end space-x-4">
            <a href="{{ route('quotations.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded font-medium">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 rounded font-medium shadow focus:ring focus:ring-blue-300">Konfirmasi Simpan</button>
        </div>
    </form>
</div>

<script>
    const products = @json($products);
    const existingItems = @json(isset($existingItems) ? $existingItems : []);

    const tbody = document.getElementById('itemsBody');
    let rowIndex = 0;

    function formatRupiah(num) {
        return Math.floor(num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function calculateTotal() {
        let globalTotal = 0;
        document.querySelectorAll('.item-row').forEach(row => {
            const qty = parseFloat(row.querySelector('.qty-input').value) || 0;
            const price = parseFloat(row.querySelector('.price-input').value) || 0;
            const discStr = row.querySelector('.disc-input').value.toString().replace(/,/g, '.');
            const disc = parseFloat(discStr) || 0;

            const subtotal = (qty * price) * (1 - (disc / 100));
            row.querySelector('.subtotal-label').innerText = formatRupiah(subtotal);
            globalTotal += subtotal;
        });
        document.getElementById('grandTotalLabel').innerText = formatRupiah(globalTotal);
    }

    function addRow(data = {}) {
        const id = rowIndex++;
        const tr = document.createElement('tr');
        tr.className = 'border-b border-gray-200 item-row hover:bg-yellow-50 transition-colors';

        let selectHtml = `<select name="items[${id}][product_id]" class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200 product-select bg-white" required onchange="handleProductChange(this)">
            <option value="">-- Pilih Produk --</option>`;
        products.forEach(p => {
            const selected = (data.product_id == p.id) ? 'selected' : '';
            const disabled = (p.stock <= 0 && data.product_id != p.id) ? 'disabled' : '';
            let stockLabel = p.stock <= 0 ? ' (Stock Kosong)' : ` (Stock: ${p.stock})`;
            if (p.stock <= 0 && data.product_id == p.id) {
                stockLabel = ' (Stock: 0)';
            }
            selectHtml += `<option value="${p.id}" data-price="${p.price}" data-stock="${p.stock}" ${selected} ${disabled}>${p.code} - ${p.name}${stockLabel}</option>`;
        });
        selectHtml += `</select>`;

        tr.innerHTML = `
            <td class="p-3">${selectHtml}</td>
            <td class="p-3"><input type="number" name="items[${id}][quantity]" value="${data.quantity || 1}" class="w-full border border-gray-300 p-2 rounded qty-input" required min="1" step="0.01" oninput="calculateTotal()"></td>
            <td class="p-3"><input type="number" name="items[${id}][price]" value="${data.price || ''}" class="w-full border border-gray-300 p-2 rounded price-input" required min="0" oninput="calculateTotal()"></td>
            <td class="p-3"><input type="number" name="items[${id}][discount]" value="${data.discount || 0}" class="w-full border border-gray-300 p-2 rounded disc-input" step="0.01" min="0" max="100" oninput="calculateTotal()"></td>
            <td class="p-3 font-bold text-gray-800 text-right pr-4 text-base">Rp <span class="subtotal-label">0</span></td>
            <td class="p-3 text-center"><button type="button" class="text-red-500 hover:text-white hover:bg-red-500 border border-red-500 px-3 py-1 rounded transition-colors" onclick="this.closest('tr').remove(); calculateTotal();">X</button></td>
        `;
        tbody.appendChild(tr);
        calculateTotal();
    }

    // Auto fill price when product is selected
    window.handleProductChange = function(selectEl) {
        const tr = selectEl.closest('tr');
        const priceInput = tr.querySelector('.price-input');
        const selectedOption = selectEl.options[selectEl.selectedIndex];

        if (selectedOption.value !== "") {
            const stock = parseInt(selectedOption.getAttribute('data-stock'));
            if (stock <= 0) {
                alert('⚠️ Produk ini tidak tersedia - stock kosong!');
                selectEl.value = '';
                return;
            }
            priceInput.value = selectedOption.getAttribute('data-price');
            calculateTotal();
        }
    }

    document.getElementById('addRowBtn').addEventListener('click', () => addRow());

    function updateDateFields() {
        const status = document.getElementById('statusInput').value;
        const approvedInput = document.getElementById('approvedDateInput');
        const closedInput = document.getElementById('closedDateInput');

        if (status === 'Approved') {
            approvedInput.disabled = false;
            closedInput.disabled = true;
            closedInput.value = '';
        } else if (status === 'Closed') {
            approvedInput.disabled = true;
            approvedInput.value = '';
            closedInput.disabled = false;
        } else {
            approvedInput.disabled = true;
            approvedInput.value = '';
            closedInput.disabled = true;
            closedInput.value = '';
        }
    }

    document.getElementById('statusInput').addEventListener('change', updateDateFields);
    updateDateFields();

    // Initialize existing rows
    if (existingItems.length > 0) {
        existingItems.forEach(item => addRow(item));
    } else {
        addRow(); // Initial row
    }

</script>
@endsection
