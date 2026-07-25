<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$res = DB::select("SELECT c.id as cashflow_id, c.invoice_id, i.number as invoice_number, c.nominal FROM cashflow c LEFT JOIN invoices i ON i.id = c.invoice_id WHERE c.invoice_id IS NOT NULL LIMIT 10");

echo json_encode($res, JSON_PRETTY_PRINT);
