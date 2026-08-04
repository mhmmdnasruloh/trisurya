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
        Schema::table('quotations', function (Blueprint $table) {
            if (!Schema::hasColumn('quotations', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable()->after('payment_term');
            }
            if (!Schema::hasColumn('quotations', 'updated_by')) {
                $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
            }
            if (!Schema::hasColumn('quotations', 'created_at')) {
                $table->timestamp('created_at')->nullable()->after('updated_by');
            }
            if (!Schema::hasColumn('quotations', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->after('created_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotations', function (Blueprint $table) {
            if (Schema::hasColumn('quotations', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
            if (Schema::hasColumn('quotations', 'created_at')) {
                $table->dropColumn('created_at');
            }
            if (Schema::hasColumn('quotations', 'updated_by')) {
                $table->dropColumn('updated_by');
            }
            if (Schema::hasColumn('quotations', 'created_by')) {
                $table->dropColumn('created_by');
            }
        });
    }
};
