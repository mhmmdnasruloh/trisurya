<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $exists = DB::select("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME = 'cashflow'
              AND COLUMN_NAME = 'invoice_id'
              AND REFERENCED_TABLE_NAME = 'invoices'");

        if (empty($exists)) {
            try {
                DB::statement("ALTER TABLE cashflow ADD CONSTRAINT fk_cashflow_invoice FOREIGN KEY (invoice_id) REFERENCES invoices(id) ON DELETE SET NULL");
            } catch (\Exception $e) {
                // ignore if cannot create
            }
        }
    }

    public function down(): void
    {
        $exists = DB::select("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME = 'cashflow'
              AND COLUMN_NAME = 'invoice_id'
              AND REFERENCED_TABLE_NAME = 'invoices'");

        if (!empty($exists)) {
            try {
                DB::statement("ALTER TABLE cashflow DROP FOREIGN KEY fk_cashflow_invoice");
            } catch (\Exception $e) {
                // ignore
            }
        }
    }
};
