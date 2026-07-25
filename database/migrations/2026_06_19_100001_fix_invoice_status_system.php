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
        Schema::table('invoices', function (Blueprint $table) {
            // Update existing statuses to Belum Bayar if they are draft/issued
            \DB::statement("UPDATE invoices SET status = 'Belum Bayar' WHERE status IN ('draft', 'issued')");
            // Update partially_paid to DP
            \DB::statement("UPDATE invoices SET status = 'DP' WHERE status = 'partially_paid'");
            // Update paid to Lunas
            \DB::statement("UPDATE invoices SET status = 'Lunas' WHERE status = 'paid'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No safe down
    }
};
