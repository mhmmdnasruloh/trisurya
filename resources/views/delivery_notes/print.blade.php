<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Jalan {{ $deliveryNote->number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .no-print {
                display: none !important;
            }

            .print-page {
                box-shadow: none !important;
                margin: 0 !important;
                padding: 2rem !important;
            }
        }

    </style>
</head>
<body class="bg-gray-100">
    <div class="no-print text-center py-4 bg-blue-600">
        <button onclick="window.print()" class="bg-white text-blue-600 font-bold px-8 py-2 rounded-lg shadow hover:bg-gray-50 transition">🖨️ Cetak Surat Jalan</button>
        <button onclick="window.close()" class="bg-gray-200 text-gray-700 font-bold px-6 py-2 rounded-lg shadow hover:bg-gray-300 transition ml-2">✕ Tutup</button>
    </div>

    <div class="print-page max-w-4xl mx-auto bg-white shadow-lg my-6 p-10">
        {{-- HEADER --}}
        <div class="flex justify-between items-start border-b-2 border-blue-600 pb-6 mb-8">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    @if(file_exists(public_path('assets/logo.png')))
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-12">
                    @endif
                    <h1 class="text-2xl font-bold text-gray-900">PT Trisurya<span class="text-blue-600">Solusindo</span></h1>
                </div>
                <p class="text-sm text-gray-500 mt-1">Solusi Terpercaya untuk Kebutuhan Bisnis Anda</p>
            </div>
            <div class="text-right">
                <h2 class="text-3xl font-bold text-blue-600 tracking-tight">DELIVERY ORDER</h2>
                <p class="text-sm text-gray-500 mt-1">Surat Jalan</p>
            </div>
        </div>

        {{-- INFO --}}
        @php
        $invoice = $deliveryNote->invoice;
        $quotation = $invoice->quotation ?? null;
        $customer = $quotation->customer ?? null;
        @endphp
        <div class="grid grid-cols-2 gap-8 mb-8">
            <div>
                <p class="text-xs text-gray-400 uppercase font-semibold tracking-wider mb-2">Dikirim Kepada</p>
                <p class="font-bold text-lg text-gray-800">{{ $customer->name ?? '-' }}</p>
                @if($deliveryNote->shipping_address)
                <p class="text-sm text-gray-600">{{ $deliveryNote->shipping_address }}</p>
                @else
                <p class="text-sm text-gray-600">{{ $customer->address ?? '' }}</p>
                @endif
                <p class="text-sm text-gray-600">{{ $customer->phone ?? '' }}</p>

                @if($deliveryNote->pic_name)
                <div class="mt-3 bg-gray-50 p-3 rounded border">
                    <p class="text-xs text-gray-400 font-semibold">Penerima (PIC)</p>
                    <p class="font-medium text-gray-800">{{ $deliveryNote->pic_name }}</p>
                    @if($deliveryNote->pic_phone)
                    <p class="text-sm text-gray-600">📞 {{ $deliveryNote->pic_phone }}</p>
                    @endif
                </div>
                @endif
            </div>
            <div class="text-right">
                <table class="ml-auto text-sm">
                    <tr>
                        <td class="text-gray-500 pr-4 py-1">No. Surat Jalan</td>
                        <td class="font-bold text-gray-800 font-mono">{{ $deliveryNote->number }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500 pr-4 py-1">No. Invoice</td>
                        <td class="font-medium text-gray-800 font-mono">{{ $invoice->number ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500 pr-4 py-1">Tanggal Kirim</td>
                        <td class="font-medium text-gray-800">{{ date('d M Y', strtotime($deliveryNote->date)) }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500 pr-4 py-1">Status</td>
                        <td class="font-bold {{ strtolower($deliveryNote->status) == 'delivered' ? 'text-green-600' : 'text-orange-600' }}">{{ $deliveryNote->status }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- TABLE ITEMS --}}
        @if($quotation && $quotation->items)
        <table class="w-full border-collapse mb-8">
            <thead>
                <tr class="bg-blue-600 text-white text-sm">
                    <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
                    <th class="py-3 px-4 text-left">Produk</th>
                    <th class="py-3 px-4 text-center">Qty</th>
                    <th class="py-3 px-4 text-left rounded-tr-lg">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotation->items as $i => $item)
                <tr class="border-b border-gray-200 {{ $i % 2 == 0 ? 'bg-gray-50' : 'bg-white' }}">
                    <td class="py-3 px-4 text-sm">{{ $i + 1 }}</td>
                    <td class="py-3 px-4 text-sm font-medium">{{ $item->product->name ?? '-' }}<br><span class="text-xs text-gray-400">{{ $item->product->code ?? '' }}</span></td>
                    <td class="py-3 px-4 text-center text-sm">{{ $item->quantity }}</td>
                    <td class="py-3 px-4 text-sm text-gray-500">-</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        {{-- TANDA TANGAN --}}
        <div class="grid grid-cols-3 gap-6 mt-16">
            <div class="text-center">
                <p class="text-sm text-gray-500 mb-20">Disiapkan oleh,</p>
                <div class="border-t border-gray-400 mx-auto w-40 pt-2">
                    <p class="font-bold text-gray-800 text-sm">Admin / Gudang</p>
                </div>
            </div>
            <div class="text-center">
                <p class="text-sm text-gray-500 mb-20">Pengirim,</p>
                <div class="border-t border-gray-400 mx-auto w-40 pt-2">
                    <p class="font-bold text-gray-800 text-sm">Driver</p>
                </div>
            </div>
            <div class="text-center">
                <p class="text-sm text-gray-500 mb-20">Penerima,</p>
                <div class="border-t border-gray-400 mx-auto w-40 pt-2">
                    <p class="font-bold text-gray-800 text-sm">{{ $deliveryNote->pic_name ?? $customer->name ?? '________________' }}</p>
                </div>
            </div>
        </div>

        <div class="mt-8 text-sm text-gray-600 border-t pt-4">
            <p><strong>Dibuat:</strong> {{ $deliveryNote->created_at ? $deliveryNote->created_at->format('d M Y H:i') : '-' }} oleh {{ $deliveryNote->createdBy->fullname ?? 'System' }}</p>
            <p><strong>Terakhir diperbarui:</strong> {{ $deliveryNote->updated_at ? $deliveryNote->updated_at->format('d M Y H:i') : '-' }} oleh {{ $deliveryNote->updatedBy->fullname ?? ($deliveryNote->createdBy->fullname ?? 'System') }}</p>
        </div>
    </div>
</body>
</html>
