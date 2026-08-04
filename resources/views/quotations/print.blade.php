<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation {{ $quotation->number }}</title>
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
        <button onclick="window.print()" class="bg-white text-blue-600 font-bold px-8 py-2 rounded-lg shadow hover:bg-gray-50 transition">🖨️ Cetak Quotation</button>
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
                <h2 class="text-3xl font-bold text-blue-600 tracking-tight">QUOTATION</h2>
                <p class="text-sm text-gray-500 mt-1">Surat Penawaran Harga</p>
            </div>
        </div>

        {{-- INFO --}}
        <div class="grid grid-cols-2 gap-8 mb-8">
            <div>
                <p class="text-xs text-gray-400 uppercase font-semibold tracking-wider mb-2">Kepada</p>
                <p class="font-bold text-lg text-gray-800">{{ $quotation->customer->name ?? '-' }}</p>
                <p class="text-sm text-gray-600">{{ $quotation->customer->address ?? '' }}</p>
                <p class="text-sm text-gray-600">{{ $quotation->customer->phone ?? '' }}</p>
            </div>
            <div class="text-right">
                <table class="ml-auto text-sm">
                    <tr>
                        <td class="text-gray-500 pr-4 py-1">No. Quotation</td>
                        <td class="font-bold text-gray-800 font-mono">{{ $quotation->number }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500 pr-4 py-1">Tanggal</td>
                        <td class="font-medium text-gray-800">{{ date('d M Y', strtotime($quotation->date)) }}</td>
                    </tr>
                    @if($quotation->created_at)
                    <tr>
                        <td class="text-gray-500 pr-4 py-1">Dibuat</td>
                        <td class="font-medium text-gray-800">{{ date('d M Y H:i', strtotime($quotation->created_at)) }} oleh {{ $quotation->createdBy->fullname ?? '-' }}</td>
                    </tr>
                    @endif
                    @if($quotation->updated_at)
                    <tr>
                        <td class="text-gray-500 pr-4 py-1">Diubah</td>
                        <td class="font-medium text-gray-800">{{ date('d M Y H:i', strtotime($quotation->updated_at)) }} oleh {{ $quotation->updatedBy->fullname ?? '-' }}</td>
                    </tr>
                    @endif
                    @if($quotation->approved_date)
                    <tr>
                        <td class="text-gray-500 pr-4 py-1">Tgl Approved</td>
                        <td class="font-medium text-gray-800">{{ date('d M Y', strtotime($quotation->approved_date)) }}</td>
                    </tr>
                    @endif
                    @if($quotation->closed_date)
                    <tr>
                        <td class="text-gray-500 pr-4 py-1">Tgl Closed</td>
                        <td class="font-medium text-gray-800">{{ date('d M Y', strtotime($quotation->closed_date)) }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td class="text-gray-500 pr-4 py-1">Sales</td>
                        <td class="font-medium text-gray-800">{{ $quotation->sales->fullname ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500 pr-4 py-1">Termin</td>
                        <td class="font-medium text-gray-800">{{ $quotation->payment_term ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500 pr-4 py-1">Status</td>
                        <td class="font-bold {{ strtolower($quotation->status) == 'approved' ? 'text-green-600' : 'text-gray-800' }}">{{ $quotation->status }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- TABLE ITEMS --}}
        <table class="w-full border-collapse mb-8">
            <thead>
                <tr class="bg-blue-600 text-white text-sm">
                    <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
                    <th class="py-3 px-4 text-left">Produk</th>
                    <th class="py-3 px-4 text-center">Qty</th>
                    <th class="py-3 px-4 text-right">Harga Satuan</th>
                    <th class="py-3 px-4 text-center">Disc</th>
                    <th class="py-3 px-4 text-right rounded-tr-lg">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotation->items as $i => $item)
                <tr class="border-b border-gray-200 {{ $i % 2 == 0 ? 'bg-gray-50' : 'bg-white' }}">
                    <td class="py-3 px-4 text-sm">{{ $i + 1 }}</td>
                    <td class="py-3 px-4 text-sm font-medium">{{ $item->product->name ?? '-' }}<br><span class="text-xs text-gray-400">{{ $item->product->code ?? '' }}</span></td>
                    <td class="py-3 px-4 text-center text-sm">{{ $item->quantity }}</td>
                    <td class="py-3 px-4 text-right text-sm">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="py-3 px-4 text-center text-sm">{{ $item->discount }}%</td>
                    @php $sub = ($item->price * $item->quantity) * (1 - $item->discount/100); @endphp
                    <td class="py-3 px-4 text-right text-sm font-bold">Rp {{ number_format($sub, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-blue-50 border-t-2 border-blue-600">
                    <td colspan="5" class="py-4 px-4 text-right font-bold text-lg text-gray-700">GRAND TOTAL</td>
                    <td class="py-4 px-4 text-right font-bold text-xl text-blue-700">Rp {{ number_format($quotation->total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        {{-- TANDA TANGAN --}}
        <div class="grid grid-cols-2 gap-8 mt-16">
            <div class="text-center">
                <p class="text-sm text-gray-500 mb-20">Hormat Kami,</p>
                <div class="border-t border-gray-400 mx-auto w-48 pt-2">
                    <p class="font-bold text-gray-800">{{ $quotation->sales->fullname ?? 'Marketing' }}</p>
                    <p class="text-xs text-gray-500">Sales / Marketing</p>
                </div>
            </div>
            <div class="text-center">
                <p class="text-sm text-gray-500 mb-20">Menyetujui,</p>
                <div class="border-t border-gray-400 mx-auto w-48 pt-2">
                    <p class="font-bold text-gray-800">{{ $quotation->customer->name ?? 'Customer' }}</p>
                    <p class="text-xs text-gray-500">Customer</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
