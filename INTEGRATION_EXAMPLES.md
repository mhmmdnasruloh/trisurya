# 🔧 INTEGRATION EXAMPLES - Cara Menggunakan Fitur Baru

File ini berisi contoh kode untuk mengintegrasikan fitur pembayaran dan laporan ke aplikasi yang sudah ada.

---

## 1. Update Invoice Controller

### Dalam `app/Http/Controllers/InvoiceController.php`

#### Update `store()` method - Set initial status:
```php
public function store(Request $request)
{
    $validated = $request->validate([
        'quotation_id' => 'required|exists:quotations,id',
        'invoice_number' => 'required|string|unique:invoices',
        'total_price' => 'required|numeric|min:0',
        // ... other validations
    ]);

    // Set initial status dan paid_amount
    $validated['status'] = 'draft';
    $validated['paid_amount'] = 0;

    $invoice = Invoice::create($validated);

    return redirect()
        ->route('invoices.show', $invoice->id)
        ->with('success', 'Invoice berhasil dibuat');
}
```

#### Update `show()` method - Add payment info:
```php
public function show(Invoice $invoice)
{
    $invoice->outstanding = $invoice->total_price - ($invoice->paid_amount ?? 0);
    $payments = $invoice->payments()->orderBy('paid_at', 'desc')->get();
    
    return view('invoices.show', compact('invoice', 'payments'));
}
```

---

## 2. Update Invoice View

### Di `resources/views/invoices/show.blade.php`

#### Tambahkan section untuk payment info:

```blade
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <!-- Invoice Details -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Invoice #{{ $invoice->id }}</h5>
                </div>
                <div class="card-body">
                    <p><strong>Customer:</strong> {{ $invoice->quotation->customer->name }}</p>
                    <p><strong>Total Price:</strong> Rp {{ number_format($invoice->total_price, 0, ',', '.') }}</p>
                    <p><strong>Tanggal:</strong> {{ $invoice->created_at->format('d-m-Y') }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge badge-{{ 
                            $invoice->status == 'paid' ? 'success' : 
                            ($invoice->status == 'partially_paid' ? 'warning' : 'secondary') 
                        }}">
                            {{ ucfirst($invoice->status ?? 'draft') }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Payment Summary -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6>Ringkasan Pembayaran</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Total Invoice:</strong></p>
                            <p style="font-size: 1.5rem; color: #007bff;">
                                Rp {{ number_format($invoice->total_price, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Sudah Dibayar:</strong></p>
                            <p style="font-size: 1.5rem; color: #28a745;">
                                Rp {{ number_format($invoice->paid_amount ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Sisa Pembayaran:</strong></p>
                            <p style="font-size: 1.5rem; color: #dc3545;">
                                Rp {{ number_format(($invoice->total_price - ($invoice->paid_amount ?? 0)), 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment History -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6>Riwayat Pembayaran</h6>
                </div>
                <div class="card-body">
                    @if($payments->count() > 0)
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Metode</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                <tr>
                                    <td>{{ $payment->paid_at->format('d-m-Y H:i') }}</td>
                                    <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($payment->method ?? '-') }}</td>
                                    <td>{{ $payment->note ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">Belum ada pembayaran</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h6>Aksi</h6>
                </div>
                <div class="card-body">
                    @if($invoice->status !== 'paid')
                        @if(auth()->user()->role !== 'admin')
                            <a href="{{ route('payments.create', $invoice->id) }}" class="btn btn-success btn-block mb-2">
                                💳 Catat Pembayaran
                            </a>
                        @else
                            <button class="btn btn-secondary btn-block mb-2" disabled>
                                💳 Catat Pembayaran (Admin tidak dapat)
                            </button>
                        @endif
                    @else
                        <button class="btn btn-success btn-block mb-2" disabled>
                            ✓ Invoice Sudah Lunas
                        </button>
                    @endif

                    <a href="{{ route('payments.index', $invoice->id) }}" class="btn btn-info btn-block mb-2">
                        📋 Lihat Pembayaran
                    </a>

                    @if(auth()->user()->role !== 'admin')
                        <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning btn-block mb-2">
                            ✎ Edit
                        </a>
                    @endif
                </div>
            </div>

            <!-- Invoice Items -->
            <div class="card">
                <div class="card-header">
                    <h6>Item yang Dipesan</h6>
                </div>
                <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                    @if($invoice->quotation->quotationItems->count() > 0)
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoice->quotation->quotationItems as $item)
                                <tr>
                                    <td>{{ $item->product->name ?? '-' }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp {{ number_format($item->unit_price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">Tidak ada item</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```

---

## 3. Update Navigation/Navbar

### Di `resources/views/layouts/app.blade.php` atau `navbar` partial:

```blade
<!-- Existing menu items -->
<a href="{{ route('quotations.index') }}" class="nav-link">Penawaran</a>
<a href="{{ route('invoices.index') }}" class="nav-link">Invoice</a>
<a href="{{ route('cashflow.index') }}" class="nav-link">Cashflow</a>

<!-- ADD THIS: Report menu untuk non-admin -->
@if(auth()->check() && auth()->user()->role !== 'admin')
    <a href="{{ route('reports.index') }}" class="nav-link">
        📊 Laporan
    </a>
@endif
```

---

## 4. Update Invoice List View

### Di `resources/views/invoices/index.blade.php`

#### Tambahkan column untuk status dan outstanding:

```blade
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Total Price</th>
            <th>Paid Amount</th>
            <th>Outstanding</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($invoices as $invoice)
        <tr>
            <td>#{{ $invoice->id }}</td>
            <td>{{ $invoice->quotation->customer->name ?? '-' }}</td>
            <td>Rp {{ number_format($invoice->total_price, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($invoice->paid_amount ?? 0, 0, ',', '.') }}</td>
            <td>
                <span class="badge badge-{{ ($invoice->total_price - ($invoice->paid_amount ?? 0)) == 0 ? 'success' : 'danger' }}">
                    Rp {{ number_format(($invoice->total_price - ($invoice->paid_amount ?? 0)), 0, ',', '.') }}
                </span>
            </td>
            <td>
                <span class="badge badge-{{ 
                    $invoice->status == 'paid' ? 'success' : 
                    ($invoice->status == 'partially_paid' ? 'warning' : 'secondary') 
                }}">
                    {{ ucfirst($invoice->status ?? 'draft') }}
                </span>
            </td>
            <td>
                <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-sm btn-info">View</a>
                @if(auth()->user()->role !== 'admin' && $invoice->status !== 'paid')
                    <a href="{{ route('payments.create', $invoice->id) }}" class="btn btn-sm btn-success">Pay</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
```

---

## 5. Update Cashflow View

### Di `resources/views/cashflow/index.blade.php`

#### Ubah query untuk hanya show payment-source entries:

```php
// Di CashflowController@index
public function index()
{
    // Get cashflow entries yang berasal dari payment
    // (tidak termasuk invoice entries lagi)
    $cashflows = Cashflow::where('source', 'payment')
        ->orWhere(function($q) {
            $q->where('source', 'manual');
        })
        ->orderBy('date', 'desc')
        ->paginate(20);
    
    return view('cashflow.index', compact('cashflows'));
}
```

#### Update view untuk show source info:

```blade
<table class="table table-striped">
    <thead>
        <tr>
            <th>Date</th>
            <th>Type</th>
            <th>Source</th>
            <th>Amount</th>
            <th>Note</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cashflows as $cf)
        <tr>
            <td>{{ date('d-m-Y', strtotime($cf->date)) }}</td>
            <td>
                <span class="badge badge-{{ $cf->type == 'income' ? 'success' : 'danger' }}">
                    {{ ucfirst($cf->type) }}
                </span>
            </td>
            <td>
                @if($cf->source == 'payment')
                    💳 Payment #{{ $cf->source_id }}
                    @if($cf->payment)
                        (Invoice #{{ $cf->payment->invoice_id }})
                    @endif
                @else
                    {{ ucfirst($cf->source) }}
                @endif
            </td>
            <td>Rp {{ number_format($cf->amount, 0, ',', '.') }}</td>
            <td>{{ $cf->note ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
```

---

## 6. Query Examples

### Get Outstanding Receivables Report:
```php
$outstanding = Invoice::selectRaw('customer_id, SUM(total_price - paid_amount) as outstanding_amount')
    ->where('status', '!=', 'paid')
    ->groupBy('customer_id')
    ->get();
```

### Get Payment Collection Report (by Customer):
```php
$collections = Payment::selectRaw('invoices.customer_id, SUM(amount) as total_paid, COUNT(*) as payment_count')
    ->join('invoices', 'payments.invoice_id', '=', 'invoices.id')
    ->whereMonth('paid_at', now()->month)
    ->groupBy('invoices.customer_id')
    ->get();
```

### Get Recent Payments:
```php
$recentPayments = Payment::with('invoice.quotation.customer')
    ->orderBy('paid_at', 'desc')
    ->limit(10)
    ->get();
```

---

## 7. Authorization Check in Blade

### Gunakan PermissionService di views:

```blade
@php
    use App\Services\PermissionService;
@endphp

<!-- Show payment button jika user bukan admin -->
@if(PermissionService::canRecordPayment())
    <a href="{{ route('payments.create', $invoice) }}" class="btn btn-success">
        Catat Pembayaran
    </a>
@endif

<!-- Show export button jika manager/owner -->
@if(PermissionService::canExportReports())
    <a href="{{ route('reports.index') }}" class="btn btn-info">
        Export Laporan
    </a>
@endif
```

---

## 8. Testing dengan Artisan Tinker

```bash
php artisan tinker

# Create test invoice
$invoice = App\Models\Invoice::first();

# Record a payment
$payment = App\Models\Payment::create([
    'invoice_id' => $invoice->id,
    'amount' => 500000,
    'method' => 'transfer',
    'paid_at' => now(),
    'created_by' => 1,
]);

# Check invoice status updated
$invoice->refresh();
$invoice->status; // "partially_paid"
$invoice->paid_amount; // 500000

# Check cashflow created
$invoice->cashflows()->get();

# Check outstanding
$invoice->outstanding; // 500000 (if total was 1000000)
```

---

**Ready to integrate!** 🚀
