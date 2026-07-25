@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-8 max-w-4xl mx-auto">
    <div class="flex items-center gap-3 mb-8 border-b border-gray-200 pb-4">
        <span class="text-3xl">📊</span>
        <h2 class="text-2xl font-bold text-gray-800">Laporan & Export Data</h2>
    </div>

    @if(!auth()->user()->hasFullAccess())
    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md mb-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Akses Ditolak</h3>
                <p class="text-sm text-red-700 mt-1">Admin tidak dapat mengakses fitur laporan dan export.</p>
            </div>
        </div>
    </div>
    @else
    
    <div class="mb-8">
        <p class="text-gray-600 mb-6">Pilih periode waktu untuk laporan yang ingin Anda export (kosongkan untuk export semua data):</p>

        <div class="grid grid-cols-1 gap-6">
            <!-- Invoices Report -->
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-xl">📄</span>
                    <h3 class="text-lg font-semibold text-blue-900">Laporan Invoice (Tagihan)</h3>
                </div>
                <form action="{{ route('reports.invoices.export') }}" method="POST" class="flex flex-col md:flex-row gap-4 items-end">
                    @csrf
                    <div class="flex-1 w-full">
                        <label class="block text-sm font-medium text-blue-800 mb-1">Tahun</label>
                        <select name="year" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2">
                            <option value="">-- Semua Tahun --</option>
                            @foreach($years as $year)
                            <option value="{{ $year }}" {{ $year == now()->year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1 w-full">
                        <label class="block text-sm font-medium text-blue-800 mb-1">Bulan</label>
                        <select name="month" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2">
                            <option value="">-- Semua Bulan --</option>
                            @for($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                            @endfor
                        </select>
                    </div>
                    <button type="submit" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg shadow transition-colors flex items-center justify-center gap-2">
                        <span>📥</span> Export Excel
                    </button>
                </form>
            </div>

            <!-- Quotations Report -->
            <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-xl">📋</span>
                    <h3 class="text-lg font-semibold text-emerald-900">Laporan Penawaran (Quotation)</h3>
                </div>
                <form action="{{ route('reports.quotations.export') }}" method="POST" class="flex flex-col md:flex-row gap-4 items-end">
                    @csrf
                    <div class="flex-1 w-full">
                        <label class="block text-sm font-medium text-emerald-800 mb-1">Tahun</label>
                        <select name="year" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-emerald-500 focus:ring-emerald-500 px-4 py-2">
                            <option value="">-- Semua Tahun --</option>
                            @foreach($years as $year)
                            <option value="{{ $year }}" {{ $year == now()->year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1 w-full">
                        <label class="block text-sm font-medium text-emerald-800 mb-1">Bulan</label>
                        <select name="month" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-emerald-500 focus:ring-emerald-500 px-4 py-2">
                            <option value="">-- Semua Bulan --</option>
                            @for($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                            @endfor
                        </select>
                    </div>
                    <button type="submit" class="w-full md:w-auto bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2 px-6 rounded-lg shadow transition-colors flex items-center justify-center gap-2">
                        <span>📥</span> Export Excel
                    </button>
                </form>
            </div>

            <!-- Deliveries Report -->
            <div class="bg-orange-50 border border-orange-100 rounded-xl p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-xl">🚚</span>
                    <h3 class="text-lg font-semibold text-orange-900">Laporan Pengiriman (Delivery)</h3>
                </div>
                <form action="{{ route('reports.deliveries.export') }}" method="POST" class="flex flex-col md:flex-row gap-4 items-end">
                    @csrf
                    <div class="flex-1 w-full">
                        <label class="block text-sm font-medium text-orange-800 mb-1">Tahun</label>
                        <select name="year" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring-orange-500 px-4 py-2">
                            <option value="">-- Semua Tahun --</option>
                            @foreach($years as $year)
                            <option value="{{ $year }}" {{ $year == now()->year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1 w-full">
                        <label class="block text-sm font-medium text-orange-800 mb-1">Bulan</label>
                        <select name="month" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring-orange-500 px-4 py-2">
                            <option value="">-- Semua Bulan --</option>
                            @for($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                            @endfor
                        </select>
                    </div>
                    <button type="submit" class="w-full md:w-auto bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-6 rounded-lg shadow transition-colors flex items-center justify-center gap-2">
                        <span>📥</span> Export Excel
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 border border-gray-200 rounded-lg p-5">
        <h4 class="font-semibold text-gray-700 flex items-center gap-2 mb-3">
            <span>💡</span> Informasi Laporan
        </h4>
        <ul class="list-disc pl-5 text-sm text-gray-600 space-y-2">
            <li>Laporan akan otomatis di-download dalam format <strong>Microsoft Excel (.xlsx)</strong>.</li>
            <li>Memilih Tahun dan Bulan akan menyaring data berdasarkan tanggal dokumen (tanggal invoice, tanggal quotation, atau tanggal pengiriman).</li>
            <li>Jika Anda mengosongkan pilihan Tahun dan Bulan, maka <strong>semua data</strong> dari awal sistem berjalan akan diexport.</li>
            <li>Gunakan fitur export ini untuk backup data bulanan atau rekonsiliasi akhir tahun.</li>
        </ul>
    </div>
    @endif
</div>
@endsection
