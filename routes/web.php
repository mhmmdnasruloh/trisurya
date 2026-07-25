<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DeliveryNoteController;
use App\Http\Controllers\CashflowController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    
    Route::resource('customers', CustomerController::class);
    Route::get('products/export', [ProductController::class, 'exportExcel'])->name('products.export');
    Route::resource('products', ProductController::class);
    Route::resource('quotations', QuotationController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::resource('delivery_notes', DeliveryNoteController::class);
    Route::get('cashflow', [CashflowController::class, 'index'])->name('cashflow.index');
    
    // Payment routes (Manager and Admin)
    Route::middleware(['role:manager,admin'])->group(function () {
        Route::get('invoices/{invoice}/payments/create', [PaymentController::class, 'create'])->name('payments.create');
        Route::post('invoices/{invoice}/payments', [PaymentController::class, 'store'])->name('payments.store');
        Route::delete('payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');
        
        // Report & Export routes
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::post('reports/invoices/export', [ReportController::class, 'exportInvoices'])->name('reports.invoices.export');
        Route::post('reports/quotations/export', [ReportController::class, 'exportQuotations'])->name('reports.quotations.export');
        Route::post('reports/deliveries/export', [ReportController::class, 'exportDeliveries'])->name('reports.deliveries.export');

        // User Admin routes
        Route::resource('users', UserController::class);
    });

    // Payment index is visible to everyone
    Route::get('invoices/{invoice}/payments', [PaymentController::class, 'index'])->name('payments.index');
});
