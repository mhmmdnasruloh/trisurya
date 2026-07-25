<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cashflow', function (Blueprint $table) {
            if (!Schema::hasColumn('cashflow', 'source')) {
                $table->string('source')->default('manual')->after('keterangan'); // payment, invoice, manual, etc
            }
            if (!Schema::hasColumn('cashflow', 'source_id')) {
                $table->integer('source_id')->nullable()->after('source');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cashflow', function (Blueprint $table) {
            $table->dropColumn(['source', 'source_id']);
        });
    }
};
