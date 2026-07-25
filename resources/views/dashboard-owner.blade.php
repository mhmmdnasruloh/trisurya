@extends('layouts.app')
@section('content')
<div class="space-y-8">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Dashboard <span class="text-blue-600">Owner</span></h1>
            <p class="text-gray-500 mt-1">Selamat datang, <span class="font-semibold text-gray-700">{{ auth()->user()->fullname ?? auth()->user()->username }}</span></p>
        </div>
        {{-- FILTER FORM --}}
        <form method="GET" action="" id="filterForm" class="flex flex-wrap items-center gap-3">
            <select name="year" class="border border-gray-300 rounded-lg px-3 py-2 bg-white text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-shadow" onchange="this.form.submit()">
                @for($year=2020; $year<=2030; $year++)
                <option value="{{ $year }}" {{ $year==$selectedYear ? 'selected' : '' }}>{{ $year }}</option>
                @endfor
            </select>
            <select name="month" class="border border-gray-300 rounded-lg px-3 py-2 bg-white text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-shadow" onchange="this.form.submit()">
                <option value="all" {{ $selectedMonth=='all' ? 'selected' : '' }}>Semua Bulan</option>
                @foreach($months as $num => $name)
                <option value="{{ $num }}" {{ $num==$selectedMonth ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
            <select name="sales" class="border border-gray-300 rounded-lg px-3 py-2 bg-white text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-shadow" onchange="this.form.submit()">
                <option value="all" {{ $selectedSales=='all' ? 'selected' : '' }}>Semua Sales</option>
                @foreach($salesOptions as $sales)
                <option value="{{ $sales->id }}" {{ $sales->id==$selectedSales ? 'selected' : '' }}>{{ $sales->fullname }}</option>
                @endforeach
            </select>
            <a href="{{ route('dashboard') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Reset</a>
        </form>
    </div>

    {{-- 3 HERO CARDS: Total Keseluruhan, Dana Masuk, Piutang --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Total Keseluruhan Dana --}}
        <div class="relative overflow-hidden rounded-2xl p-6 text-white shadow-xl" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="absolute top-0 right-0 w-32 h-32 transform translate-x-8 -translate-y-8">
                <div class="w-full h-full rounded-full opacity-10 bg-white"></div>
            </div>
            <div class="absolute bottom-0 left-0 w-24 h-24 transform -translate-x-6 translate-y-6">
                <div class="w-full h-full rounded-full opacity-10 bg-white"></div>
            </div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium opacity-90">Total Keseluruhan Dana</p>
                </div>
                <p class="text-3xl font-extrabold tracking-tight">Rp {{ number_format($totalKeseluruhanDana, 0, ',', '.') }}</p>
                <p class="text-xs mt-2 opacity-70">Dana masuk + piutang yang belum terbayar</p>
            </div>
        </div>

        {{-- Dana Masuk --}}
        <div class="relative overflow-hidden rounded-2xl p-6 text-white shadow-xl" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
            <div class="absolute top-0 right-0 w-32 h-32 transform translate-x-8 -translate-y-8">
                <div class="w-full h-full rounded-full opacity-10 bg-white"></div>
            </div>
            <div class="absolute bottom-0 left-0 w-24 h-24 transform -translate-x-6 translate-y-6">
                <div class="w-full h-full rounded-full opacity-10 bg-white"></div>
            </div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium opacity-90">Dana Masuk</p>
                </div>
                <p class="text-3xl font-extrabold tracking-tight">Rp {{ number_format($totalDanaMasuk, 0, ',', '.') }}</p>
                <p class="text-xs mt-2 opacity-70">Total pembayaran yang sudah diterima</p>
            </div>
        </div>

        {{-- Total Piutang --}}
        <div class="relative overflow-hidden rounded-2xl p-6 text-white shadow-xl" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="absolute top-0 right-0 w-32 h-32 transform translate-x-8 -translate-y-8">
                <div class="w-full h-full rounded-full opacity-10 bg-white"></div>
            </div>
            <div class="absolute bottom-0 left-0 w-24 h-24 transform -translate-x-6 translate-y-6">
                <div class="w-full h-full rounded-full opacity-10 bg-white"></div>
            </div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium opacity-90">Total Piutang</p>
                </div>
                <p class="text-3xl font-extrabold tracking-tight">Rp {{ number_format($totalPiutang, 0, ',', '.') }}</p>
                <p class="text-xs mt-2 opacity-70">Sisa tagihan yang belum dilunasi</p>
            </div>
        </div>
    </div>

    {{-- STATISTIK PENAWARAN --}}
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
            <h2 class="text-xl font-bold text-gray-800">Statistik Penawaran</h2>
            <p class="text-sm text-gray-500 mt-1">{{ $selectedMonth=='all' ? 'Semua Bulan' : $months[$selectedMonth] }} {{ $selectedYear }}</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Total --}}
                <div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl p-5 border border-slate-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Total</p>
                        <div class="w-10 h-10 bg-slate-200 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-800">{{ $totalCount }}</p>
                    <p class="text-sm text-slate-500 mt-1">Rp {{ number_format($totalValue, 0, ',', '.') }}</p>
                    <p class="text-xs text-slate-400 mt-2">Approved + Closed + Open</p>
                </div>

                {{-- Approved --}}
                <div class="bg-gradient-to-br from-amber-50 to-yellow-50 rounded-xl p-5 border border-amber-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-sm font-semibold text-amber-700 uppercase tracking-wide">Approved</p>
                        <div class="w-10 h-10 bg-amber-200 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-extrabold text-amber-800">{{ $dataApproved->total ?? 0 }}</p>
                    <p class="text-sm text-amber-600 mt-1">Rp {{ number_format($dataApproved->total_value ?? 0, 0, ',', '.') }}</p>
                    <div class="mt-3">
                        <div class="w-full bg-amber-200 rounded-full h-2">
                            <div class="bg-amber-500 h-2 rounded-full transition-all duration-500" style="width: {{ $approvedPercentage }}%"></div>
                        </div>
                        <p class="text-xs text-amber-500 mt-1">{{ $approvedPercentage }}% dari total</p>
                    </div>
                </div>

                {{-- Closed --}}
                <div class="bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl p-5 border border-emerald-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-sm font-semibold text-emerald-700 uppercase tracking-wide">Closed</p>
                        <div class="w-10 h-10 bg-emerald-200 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-extrabold text-emerald-800">{{ $dataClosed->total ?? 0 }}</p>
                    <p class="text-sm text-emerald-600 mt-1">Rp {{ number_format($dataClosed->total_value ?? 0, 0, ',', '.') }}</p>
                    <div class="mt-3">
                        <div class="w-full bg-emerald-200 rounded-full h-2">
                            <div class="bg-emerald-500 h-2 rounded-full transition-all duration-500" style="width: {{ $closedPercentage }}%"></div>
                        </div>
                        <p class="text-xs text-emerald-500 mt-1">{{ $closedPercentage }}% dari total</p>
                    </div>
                </div>

                {{-- Open --}}
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-5 border border-blue-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-sm font-semibold text-blue-700 uppercase tracking-wide">Open</p>
                        <div class="w-10 h-10 bg-blue-200 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-extrabold text-blue-800">{{ $dataOpen->total ?? 0 }}</p>
                    <p class="text-sm text-blue-600 mt-1">Rp {{ number_format($dataOpen->total_value ?? 0, 0, ',', '.') }}</p>
                    <div class="mt-3">
                        <div class="w-full bg-blue-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full transition-all duration-500" style="width: {{ $openPercentage }}%"></div>
                        </div>
                        <p class="text-xs text-blue-500 mt-1">{{ $openPercentage }}% dari total</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- DUE INVOICES --}}
    @if(count($dueCustomers) > 0)
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-red-50 to-orange-50">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <span class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></span>
                        Invoice Jatuh Tempo
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">Invoice yang mendekati atau melewati jatuh tempo</p>
                </div>
                <div class="flex gap-4 text-sm">
                    <div class="bg-red-100 rounded-lg px-3 py-2">
                        <p class="text-red-600 font-bold">{{ $countOverdue }} Overdue</p>
                        <p class="text-red-500 text-xs">Rp {{ number_format($totalOverdue, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-amber-100 rounded-lg px-3 py-2">
                        <p class="text-amber-600 font-bold">{{ $countDueSoon }} Segera</p>
                        <p class="text-amber-500 text-xs">Rp {{ number_format($totalDueSoon, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="divide-y divide-gray-100">
            @foreach($dueCustomers as $customer)
            <div class="p-5 hover:bg-gray-50/50 transition-colors">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <h3 class="font-bold text-gray-800">{{ $customer['name'] }}</h3>
                        <p class="text-xs text-gray-500">{{ $customer['phone'] }} • {{ $customer['email'] }}</p>
                    </div>
                    <div class="text-right">
                        @if($customer['count_overdue'] > 0)
                        <span class="inline-flex items-center px-2 py-1 text-xs font-bold rounded-full bg-red-100 text-red-700">
                            {{ $customer['count_overdue'] }} Overdue — Rp {{ number_format($customer['total_overdue'], 0, ',', '.') }}
                        </span>
                        @endif
                        @if($customer['count_due_soon'] > 0)
                        <span class="inline-flex items-center px-2 py-1 text-xs font-bold rounded-full bg-amber-100 text-amber-700 ml-1">
                            {{ $customer['count_due_soon'] }} Segera — Rp {{ number_format($customer['total_due_soon'], 0, ',', '.') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="space-y-2">
                    @foreach($customer['invoices'] as $inv)
                    <div class="flex items-center justify-between bg-{{ $inv->status_category === 'overdue' ? 'red' : 'amber' }}-50 rounded-lg px-4 py-2 text-sm">
                        <div class="flex items-center gap-3">
                            <span class="font-mono font-bold text-{{ $inv->status_category === 'overdue' ? 'red' : 'amber' }}-700">{{ $inv->number }}</span>
                            <span class="text-gray-500">JT: {{ date('d M Y', strtotime($inv->due_date)) }}</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="font-bold text-gray-700">Rp {{ number_format($inv->calculated_total, 0, ',', '.') }}</span>
                            <span class="px-2 py-0.5 text-xs font-bold rounded {{ $inv->status_category === 'overdue' ? 'bg-red-200 text-red-800' : 'bg-amber-200 text-amber-800' }}">
                                {{ $inv->status_text }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .space-y-8 > * {
        animation: fadeInUp 0.5s ease-out both;
    }
    .space-y-8 > *:nth-child(1) { animation-delay: 0.05s; }
    .space-y-8 > *:nth-child(2) { animation-delay: 0.15s; }
    .space-y-8 > *:nth-child(3) { animation-delay: 0.25s; }
    .space-y-8 > *:nth-child(4) { animation-delay: 0.35s; }
</style>
@endsection
