#!/usr/bin/env php
<?php

// Load Laravel
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);

// Get database connection
$db = \Illuminate\Support\Facades\DB::connection();

// Drop payments table
try {
    $db->statement('DROP TABLE IF EXISTS payments');
    echo "✓ Payments table dropped\n";
} catch (\Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}

// Delete migration records
try {
    $db->table('migrations')
        ->whereIn('migration', [
            '2026_06_19_000001_create_payments_table',
            '2026_06_19_000002_add_payment_fields_to_invoices',
            '2026_06_19_000003_add_source_to_cashflow',
        ])
        ->delete();
    echo "✓ Migration records deleted\n";
} catch (\Exception $e) {
    echo "✗ Error deleting migrations: " . $e->getMessage() . "\n";
}

echo "\nNow you can run: php artisan migrate\n";
