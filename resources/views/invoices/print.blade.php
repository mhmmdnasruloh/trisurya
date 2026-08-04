<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoice->number }}</title>
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
        <button onclick="window.print()" class="bg-white text-blue-600 font-bold px-8 py-2 rounded-lg shadow hover:bg-gray-50 transition">🖨️ Cetak Invoice</button>
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
                <h2 class="text-3xl font-bold text-blue-600 tracking-tight">INVOICE</h2>
                <p class="text-sm text-gray-500 mt-1">Surat Tagihan</p>
            </div>
        </div>

        {{-- INFO --}}
        @php $quotation = $invoice->quotation; @endphp
        <div class="grid grid-cols-2 gap-8 mb-8">
            <div>
                <p class="text-xs text-gray-400 uppercase font-semibold tracking-wider mb-2">Tagihan Kepada</p>
                <p class="font-bold text-lg text-gray-800">{{ $quotation->customer->name ?? '-' }}</p>
                <p class="text-sm text-gray-600">{{ $quotation->customer->address ?? '' }}</p>
                <p class="text-sm text-gray-600">{{ $quotation->customer->phone ?? '' }}</p>
            </div>
            <div class="text-right">
                <table class="ml-auto text-sm">
                    <tr>
                        <td class="text-gray-500 pr-4 py-1">No. Invoice</td>
                        <td class="font-bold text-gray-800 font-mono">{{ $invoice->number }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500 pr-4 py-1">No. Quotation</td>
                        <td class="font-medium text-gray-800 font-mono">{{ $quotation->number ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500 pr-4 py-1">Tanggal</td>
                        <td class="font-medium text-gray-800">{{ date('d M Y', strtotime($invoice->date)) }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500 pr-4 py-1">Jatuh Tempo</td>
                        <td class="font-bold text-red-600">{{ date('d M Y', strtotime($invoice->due_date)) }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-500 pr-4 py-1">Status</td>
                        <td class="font-bold {{ strtolower($invoice->status) == 'lunas' ? 'text-green-600' : 'text-red-600' }}">{{ $invoice->status }}</td>
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
                @php
                $invoiceTotal = $invoice->total;
                $paidAmount = $invoice->paid_amount ?? 0;
                $outstanding = $invoice->outstanding;
                @endphp
                <tr class="bg-gray-50 border-t border-gray-200">
                    <td colspan="5" class="py-3 px-4 text-right font-medium text-gray-600">Subtotal Barang</td>
                    <td class="py-3 px-4 text-right text-gray-800">Rp {{ number_format($invoiceTotal, 0, ',', '.') }}</td>
                </tr>
                <tr class="bg-blue-50 border-t-2 border-blue-600">
                    <td colspan="5" class="py-4 px-4 text-right font-bold text-lg text-gray-700">TOTAL TAGIHAN</td>
                    <td class="py-4 px-4 text-right font-bold text-xl text-blue-700">Rp {{ number_format($invoiceTotal, 0, ',', '.') }}</td>
                </tr>
                @if($paidAmount > 0)
                <tr class="bg-green-50 border-t border-green-200">
                    <td colspan="5" class="py-3 px-4 text-right font-medium text-green-700">Total Dibayar</td>
                    <td class="py-3 px-4 text-right font-bold text-green-700">Rp {{ number_format($paidAmount, 0, ',', '.') }}</td>
                </tr>
                <tr class="bg-yellow-50 border-t border-yellow-200">
                    <td colspan="5" class="py-3 px-4 text-right font-medium text-yellow-700">Sisa Tagihan</td>
                    <td class="py-3 px-4 text-right font-bold text-yellow-700">Rp {{ number_format($outstanding, 0, ',', '.') }}</td>
                </tr>
                @endif
            </tfoot>
        </table>

        @if($invoice->payments && $invoice->payments->count() > 0)
        <div class="mb-8">
            <h3 class="text-md font-bold text-gray-800 border-b border-gray-300 pb-2 mb-4">Riwayat Pembayaran</h3>
            <table class="w-full text-sm text-left">
                <thead class="text-gray-600 bg-gray-50 border-b">
                    <tr>
                        <th class="py-2 px-3">Tanggal</th>
                        <th class="py-2 px-3">Metode</th>
                        <th class="py-2 px-3 text-right">Nominal</th>
                        <th class="py-2 px-3">Dicatat Oleh</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->payments as $payment)
                    <tr class="border-b">
                        <td class="py-2 px-3">{{ $payment->paid_at->format('d M Y') }}</td>
                        <td class="py-2 px-3">{{ $payment->method ?? '-' }}</td>
                        <td class="py-2 px-3 text-right font-medium text-green-600">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                        <td class="py-2 px-3">{{ $payment->createdBy->fullname ?? 'Admin' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        @if($invoice->notes)
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-8">
            <p class="text-xs text-yellow-600 font-semibold uppercase mb-1">Catatan:</p>
            <p class="text-sm text-gray-700">{{ $invoice->notes }}</p>
        </div>
        @endif

        {{-- TANDA TANGAN --}}
        <div class="grid grid-cols-2 gap-8 mt-16">
            <div class="text-center">
                <p class="text-sm text-gray-500 mb-20">Hormat Kami,</p>
                <div class="border-t border-gray-400 mx-auto w-48 pt-2">
                    <p class="font-bold text-gray-800">PT TrisuryaSolusindo</p>
                    <p class="text-xs text-gray-500">Finance / Admin</p>
                </div>
            </div>
            <div class="text-center">
                <p class="text-sm text-gray-500 mb-20">Penerima,</p>
                <div class="border-t border-gray-400 mx-auto w-48 pt-2">
                    <p class="font-bold text-gray-800">{{ $quotation->customer->name ?? 'Customer' }}</p>
                    <p class="text-xs text-gray-500">Customer</p>
                </div>
            </div>
        </div>

        <div class="mt-8 text-sm text-gray-600 border-t pt-4">
            <p><strong>Dibuat:</strong> {{ $invoice->created_at ? $invoice->created_at->format('d M Y H:i') : '-' }} oleh {{ $invoice->createdBy->fullname ?? 'System' }}</p>
            <p><strong>Terakhir diperbarui:</strong> {{ $invoice->updated_at ? $invoice->updated_at->format('d M Y H:i') : '-' }} oleh {{ $invoice->updatedBy->fullname ?? ($invoice->createdBy->fullname ?? 'System') }}</p>
        </div>
    </div>
</body>
</html>
