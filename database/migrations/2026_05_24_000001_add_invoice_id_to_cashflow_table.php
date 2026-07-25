<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cashflow', function (Blueprint $table) {
            if (!Schema::hasColumn('cashflow', 'invoice_id')) {
                $table->foreignId('invoice_id')->nullable()->constrained('invoices')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('cashflow', function (Blueprint $table) {
            if (Schema::hasColumn('cashflow', 'invoice_id')) {
                $table->dropForeign(['invoice_id']);
                $table->dropColumn('invoice_id');
            }
        });
    }
};
