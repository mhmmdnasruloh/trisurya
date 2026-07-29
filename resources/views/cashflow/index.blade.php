@extends('layouts.app')
@section('content')
<div class="space-y-8">

    {{-- FILTER  --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800">Filter Data Cashflow</h3>
                <p class="text-xs text-gray-500">Atur periode untuk melihat data keuangan</p>
            </div>
        </div>
        <form method="GET" action="{{ route('cashflow.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Dari Tanggal</label>
                <input type="date" name="from_date" value="{{ request('from_date') }}" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition-shadow text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Sampai Tanggal</label>
                <input type="date" name="to_date" value="{{ request('to_date') }}" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition-shadow text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Bulan</label>
                <select name="month" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition-shadow text-sm">
                    <option value="">-- Semua Bulan --</option>
                    @for ($m = 1; $m <= 12; $m++) <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>{{ date('F', mktime(0,0,0,$m,1)) }}</option>
                        @endfor
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Tahun</label>
                <select name="year" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition-shadow text-sm">
                    <option value="">-- Semua Tahun --</option>
                    @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition-colors shadow-sm text-sm">
                    Filter
                </button>
                <a href="{{ route('cashflow.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2.5 px-4 rounded-lg text-center transition-colors text-sm">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- ACTIVE PERIOD INDICATOR --}}
    @php
    $periodLabel = '';
    if ($fromDate || $toDate) {
    $periodLabel = ($fromDate ? date('d M Y', strtotime($fromDate)) : '...') . ' – ' . ($toDate ? date('d M Y', strtotime($toDate)) : '...');
    } elseif ($month && $year) {
    $bulanNames = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $periodLabel = ($bulanNames[(int)$month] ?? '') . ' ' . $year;
    } elseif ($year) {
    $periodLabel = 'Tahun ' . $year;
    } elseif ($month) {
    $bulanNames = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $periodLabel = $bulanNames[(int)$month] ?? '';
    } else {
    $periodLabel = 'Semua Periode';
    }
    @endphp
    <div class="flex items-center gap-3 px-1">
        <span class="inline-flex items-center gap-2 bg-blue-50 border border-blue-200 text-blue-700 text-sm font-medium px-4 py-2 rounded-full">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
            Menampilkan data: <strong>{{ $periodLabel }}</strong>
        </span>
        @if($year == date('Y') && !$month && !$fromDate && !$toDate)
        <span class="text-xs text-gray-400 italic">← default tahun berjalan</span>
        @endif
    </div>

    {{-- 3 RINGKASAN CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Total Keseluruhan --}}
        <div class="relative overflow-hidden rounded-2xl p-6 text-white shadow-xl" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="absolute top-0 right-0 w-28 h-28 transform translate-x-6 -translate-y-6">
                <div class="w-full h-full rounded-full opacity-10 bg-white"></div>
            </div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-11 h-11 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium opacity-90">Total Keseluruhan Dana</p>
                </div>
                <p class="text-2xl font-extrabold tracking-tight">Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</p>
                <p class="text-xs mt-2 opacity-70">Dana masuk + piutang outstanding</p>
            </div>
        </div>

        {{-- Dana Masuk --}}
        <div class="relative overflow-hidden rounded-2xl p-6 text-white shadow-xl" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
            <div class="absolute top-0 right-0 w-28 h-28 transform translate-x-6 -translate-y-6">
                <div class="w-full h-full rounded-full opacity-10 bg-white"></div>
            </div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-11 h-11 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium opacity-90">Dana Sudah Masuk</p>
                </div>
                <p class="text-2xl font-extrabold tracking-tight">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                <p class="text-xs mt-2 opacity-70">Total pembayaran yang sudah diterima</p>
            </div>
        </div>

        {{-- Piutang --}}
        <div class="relative overflow-hidden rounded-2xl p-6 text-white shadow-xl" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="absolute top-0 right-0 w-28 h-28 transform translate-x-6 -translate-y-6">
                <div class="w-full h-full rounded-full opacity-10 bg-white"></div>
            </div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-11 h-11 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium opacity-90">Total Piutang</p>
                </div>
                <p class="text-2xl font-extrabold tracking-tight">Rp {{ number_format($totalPiutang, 0, ',', '.') }}</p>
                <p class="text-xs mt-2 opacity-70">Sisa tagihan yang belum dilunasi</p>
            </div>
        </div>
    </div>

    {{-- TAB NAVIGATION --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
        {{-- Tab Buttons --}}
        <div class="flex border-b border-gray-200">
            <button onclick="switchTab('dana-masuk')" id="tab-dana-masuk" class="tab-btn flex-1 py-4 px-6 text-center font-semibold text-sm transition-all border-b-2 border-green-500 text-green-700 bg-green-50/50">
                <span class="flex items-center justify-center gap-2">
                    <span class="w-2.5 h-2.5 bg-green-500 rounded-full"></span>
                    Dana Masuk ({{ $incomes->count() }})
                </span>
            </button>
            <button onclick="switchTab('piutang')" id="tab-piutang" class="tab-btn flex-1 py-4 px-6 text-center font-semibold text-sm transition-all border-b-2 border-transparent text-gray-500 hover:text-orange-600 hover:bg-orange-50/30">
                <span class="flex items-center justify-center gap-2">
                    <span class="w-2.5 h-2.5 bg-orange-500 rounded-full"></span>
                    Piutang ({{ $piutangs->count() }})
                </span>
            </button>
        </div>

        {{-- Tab Content: Dana Masuk --}}
        <div id="content-dana-masuk" class="tab-content">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-green-50 border-b border-green-100">
                            <th class="py-3 px-5 text-left font-semibold text-green-800 text-sm">Tanggal</th>
                            <th class="py-3 px-5 text-left font-semibold text-green-800 text-sm">Keterangan</th>
                            <th class="py-3 px-5 text-left font-semibold text-green-800 text-sm">Kategori</th>
                            <th class="py-3 px-5 text-right font-semibold text-green-800 text-sm">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($incomes as $cf)
                        <tr class="border-b border-gray-100 hover:bg-green-50/30 transition-colors">
                            <td class="py-3 px-5 text-sm text-gray-600">{{ date('d M Y', strtotime($cf->tanggal)) }}</td>
                            <td class="py-3 px-5 font-medium text-sm text-gray-800">{{ $cf->keterangan }}</td>
                            <td class="py-3 px-5">
                                <span class="px-2.5 py-1 text-xs rounded-full font-semibold bg-green-100 text-green-800">{{ $cf->kategori ?? '-' }}</span>
                            </td>
                            <td class="py-3 px-5 text-right font-bold text-green-600">+ Rp {{ number_format($cf->nominal, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-gray-400 text-sm">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    Belum ada dana masuk tercatat.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tab Content: Piutang --}}
        <div id="content-piutang" class="tab-content" style="display: none;">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-orange-50 border-b border-orange-100">
                            <th class="py-3 px-5 text-left font-semibold text-orange-800 text-sm">Tgl Invoice / Jatuh Tempo</th>
                            <th class="py-3 px-5 text-left font-semibold text-orange-800 text-sm">Invoice / Customer</th>
                            <th class="py-3 px-5 text-left font-semibold text-orange-800 text-sm">Status</th>
                            <th class="py-3 px-5 text-right font-semibold text-orange-800 text-sm">Total</th>
                            <th class="py-3 px-5 text-right font-semibold text-orange-800 text-sm">Terbayar</th>
                            <th class="py-3 px-5 text-right font-semibold text-orange-800 text-sm">Sisa (Piutang)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($piutangs as $inv)
                        <tr class="border-b border-gray-100 hover:bg-orange-50/30 transition-colors">
                            <td class="py-3 px-5 text-sm">
                                <span class="text-gray-700">{{ date('d M Y', strtotime($inv->date)) }}</span><br>
                                <span class="{{ strtotime($inv->due_date) < time() ? 'text-red-600 font-bold' : 'text-gray-500' }} text-xs">JT: {{ date('d M Y', strtotime($inv->due_date)) }}</span>
                            </td>
                            <td class="py-3 px-5">
                                <a href="{{ route('invoices.show', $inv->id) }}" target="_blank" class="font-bold text-blue-600 hover:underline text-sm">{{ $inv->number }}</a><br>
                                <span class="text-xs text-gray-500">{{ $inv->quotation->customer->name ?? '-' }}</span>
                            </td>
                            <td class="py-3 px-5">
                                @php
                                $stsColor = strtoupper($inv->status) == 'DP' ? 'bg-amber-100 text-amber-800' : 'bg-red-100 text-red-800';
                                @endphp
                                <span class="px-2.5 py-1 text-xs rounded-full font-bold {{ $stsColor }}">{{ $inv->status }}</span>
                            </td>
                            <td class="py-3 px-5 text-right text-sm text-gray-600">Rp {{ number_format($inv->total, 0, ',', '.') }}</td>
                            <td class="py-3 px-5 text-right text-sm text-green-600">Rp {{ number_format($inv->paid_amount, 0, ',', '.') }}</td>
                            <td class="py-3 px-5 text-right font-bold text-orange-600">Rp {{ number_format($inv->outstanding, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-gray-400 text-sm">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Tidak ada piutang. Semua invoice sudah lunas! 🎉
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    function switchTab(tab) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');

        // Reset all tab buttons
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('border-green-500', 'text-green-700', 'bg-green-50/50', 'border-orange-500', 'text-orange-700', 'bg-orange-50/50');
            btn.classList.add('border-transparent', 'text-gray-500');
        });

        // Show selected tab content
        document.getElementById('content-' + tab).style.display = 'block';

        // Activate selected tab button
        const activeBtn = document.getElementById('tab-' + tab);
        activeBtn.classList.remove('border-transparent', 'text-gray-500');

        if (tab === 'dana-masuk') {
            activeBtn.classList.add('border-green-500', 'text-green-700', 'bg-green-50/50');
        } else {
            activeBtn.classList.add('border-orange-500', 'text-orange-700', 'bg-orange-50/50');
        }
    }

</script>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .space-y-8>* {
        animation: fadeInUp 0.5s ease-out both;
    }

    .space-y-8>*:nth-child(1) {
        animation-delay: 0.05s;
    }

    .space-y-8>*:nth-child(2) {
        animation-delay: 0.15s;
    }

    .space-y-8>*:nth-child(3) {
        animation-delay: 0.25s;
    }

</style>
@endsection
