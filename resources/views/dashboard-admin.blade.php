@extends('layouts.app')
@section('content')
<div class="space-y-8">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-500 mt-1">Selamat datang, <span class="font-semibold text-gray-700">{{ auth()->user()->fullname ?? auth()->user()->username }}</span> <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-full bg-blue-100 text-blue-700">{{ auth()->user()->role }}</span></p>
        </div>
        {{-- FILTER --}}
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
            <a href="{{ route('dashboard') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Reset</a>
        </form>
    </div>

    {{-- QUICK STATS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Total Quotations --}}
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 hover:shadow-lg transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-extrabold text-gray-800">{{ $totalQuotations }}</p>
            <p class="text-sm text-gray-500 mt-1">Total Penawaran</p>
        </div>

        {{-- Approved --}}
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 hover:shadow-lg transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="px-2 py-1 text-xs font-bold rounded-full bg-amber-100 text-amber-700">In Progress</span>
            </div>
            <p class="text-3xl font-extrabold text-gray-800">{{ $countApproved }}</p>
            <p class="text-sm text-gray-500 mt-1">Approved</p>
        </div>

        {{-- Closed --}}
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 hover:shadow-lg transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="px-2 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-700">Clear</span>
            </div>
            <p class="text-3xl font-extrabold text-gray-800">{{ $countClosed }}</p>
            <p class="text-sm text-gray-500 mt-1">Closed</p>
        </div>

        {{-- Open --}}
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 hover:shadow-lg transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <span class="px-2 py-1 text-xs font-bold rounded-full bg-blue-100 text-blue-700">Pending</span>
            </div>
            <p class="text-3xl font-extrabold text-gray-800">{{ $countOpen }}</p>
            <p class="text-sm text-gray-500 mt-1">Open</p>
        </div>
    </div>

    {{-- PROGRESS BAR VISUAL --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6">
        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Distribusi Status Penawaran</h3>
        @if($totalQuotations > 0)
        <div class="flex rounded-full overflow-hidden h-4 bg-gray-100">
            @if($countClosed > 0)
            <div class="bg-emerald-500 transition-all duration-700" style="width: {{ ($countClosed/$totalQuotations)*100 }}%" title="Closed: {{ $countClosed }}"></div>
            @endif
            @if($countApproved > 0)
            <div class="bg-amber-400 transition-all duration-700" style="width: {{ ($countApproved/$totalQuotations)*100 }}%" title="Approved: {{ $countApproved }}"></div>
            @endif
            @if($countOpen > 0)
            <div class="bg-blue-400 transition-all duration-700" style="width: {{ ($countOpen/$totalQuotations)*100 }}%" title="Open: {{ $countOpen }}"></div>
            @endif
        </div>
        <div class="flex items-center gap-6 mt-3 text-sm">
            <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-emerald-500"></span> Closed ({{ $countClosed }})</div>
            <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-amber-400"></span> Approved ({{ $countApproved }})</div>
            <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-blue-400"></span> Open ({{ $countOpen }})</div>
        </div>
        @else
        <p class="text-gray-400 text-sm">Belum ada data penawaran untuk periode ini.</p>
        @endif
    </div>

    {{-- QUICK LINKS --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('quotations.create') }}" class="bg-white rounded-xl border border-gray-200 p-5 hover:border-blue-400 hover:shadow-md transition-all group text-center">
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-100 transition-colors">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <p class="text-sm font-semibold text-gray-700 group-hover:text-blue-600 transition-colors">Buat Quotation</p>
        </a>
        <a href="{{ route('invoices.index') }}" class="bg-white rounded-xl border border-gray-200 p-5 hover:border-emerald-400 hover:shadow-md transition-all group text-center">
            <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-emerald-100 transition-colors">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-sm font-semibold text-gray-700 group-hover:text-emerald-600 transition-colors">Lihat Invoice</p>
        </a>
        <a href="{{ route('customers.index') }}" class="bg-white rounded-xl border border-gray-200 p-5 hover:border-purple-400 hover:shadow-md transition-all group text-center">
            <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-purple-100 transition-colors">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <p class="text-sm font-semibold text-gray-700 group-hover:text-purple-600 transition-colors">Customers</p>
        </a>
        <a href="{{ route('products.index') }}" class="bg-white rounded-xl border border-gray-200 p-5 hover:border-orange-400 hover:shadow-md transition-all group text-center">
            <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-orange-100 transition-colors">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <p class="text-sm font-semibold text-gray-700 group-hover:text-orange-600 transition-colors">Products</p>
        </a>
    </div>

    {{-- TWO COLUMNS: Recent Quotations + Recent Invoices --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Quotations --}}
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                    Quotation Terbaru
                </h3>
                <a href="{{ route('quotations.index') }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Lihat Semua →</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($recentQuotations as $q)
                <div class="px-5 py-3 hover:bg-gray-50/50 transition-colors flex items-center justify-between">
                    <div>
                        <p class="font-mono font-bold text-sm text-blue-600">{{ $q->number }}</p>
                        <p class="text-xs text-gray-500">{{ $q->customer_name ?? '-' }} • {{ date('d M Y', strtotime($q->date)) }}</p>
                    </div>
                    @php
                        $sts = strtoupper(trim($q->status));
                        $color = $sts == 'CLOSED' ? 'bg-emerald-100 text-emerald-700' : ($sts == 'APPROVED' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700');
                    @endphp
                    <span class="px-2 py-0.5 text-xs font-bold rounded-full {{ $color }}">{{ $q->status }}</span>
                </div>
                @empty
                <div class="px-5 py-8 text-center text-gray-400 text-sm">Belum ada data quotation.</div>
                @endforelse
            </div>
        </div>

        {{-- Recent Invoices --}}
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                    Invoice Terbaru
                </h3>
                <a href="{{ route('invoices.index') }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Lihat Semua →</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($recentInvoices as $inv)
                <div class="px-5 py-3 hover:bg-gray-50/50 transition-colors flex items-center justify-between">
                    <div>
                        <p class="font-mono font-bold text-sm text-gray-700">{{ $inv->number }}</p>
                        <p class="text-xs text-gray-500">{{ $inv->customer_name ?? '-' }} • {{ date('d M Y', strtotime($inv->date)) }}</p>
                    </div>
                    @php
                        $invSts = strtoupper(trim($inv->status));
                        $invColor = $invSts == 'LUNAS' ? 'bg-emerald-100 text-emerald-700' : ($invSts == 'DP' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700');
                    @endphp
                    <span class="px-2 py-0.5 text-xs font-bold rounded-full {{ $invColor }}">{{ $inv->status }}</span>
                </div>
                @empty
                <div class="px-5 py-8 text-center text-gray-400 text-sm">Belum ada data invoice.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Recent Payments --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden mt-6">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                Pembayaran Terbaru
            </h3>
            <a href="{{ route('cashflow.index') }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Lihat Semua →</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($recentPayments as $p)
            <div class="px-5 py-3 hover:bg-gray-50/50 transition-colors flex items-center justify-between">
                <div>
                    <p class="font-mono font-bold text-sm text-gray-700">{{ $p->invoice_number ?? '-' }}</p>
                    <p class="text-xs text-gray-500">{{ date('d M Y', strtotime($p->tanggal)) }} • {{ $p->created_by_name ?? 'System' }}</p>
                </div>
                <span class="px-2 py-0.5 text-sm font-bold rounded-full bg-green-100 text-green-700">Rp {{ number_format($p->nominal, 0, ',', '.') }}</span>
            </div>
            @empty
            <div class="px-5 py-8 text-center text-gray-400 text-sm">Belum ada pembayaran tercatat.</div>
            @endforelse
        </div>
    </div>

    {{-- MASTER DATA SUMMARY --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 flex items-center gap-5 hover:shadow-lg transition-shadow">
            <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-3xl font-extrabold text-gray-800">{{ $totalCustomers }}</p>
                <p class="text-sm text-gray-500">Total Customer Terdaftar</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 flex items-center gap-5 hover:shadow-lg transition-shadow">
            <div class="w-14 h-14 bg-orange-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <div>
                <p class="text-3xl font-extrabold text-gray-800">{{ $totalProducts }}</p>
                <p class="text-sm text-gray-500">Total Produk Terdaftar</p>
            </div>
        </div>
    </div>

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
    .space-y-8 > *:nth-child(2) { animation-delay: 0.1s; }
    .space-y-8 > *:nth-child(3) { animation-delay: 0.15s; }
    .space-y-8 > *:nth-child(4) { animation-delay: 0.2s; }
    .space-y-8 > *:nth-child(5) { animation-delay: 0.25s; }
    .space-y-8 > *:nth-child(6) { animation-delay: 0.3s; }
</style>
@endsection
