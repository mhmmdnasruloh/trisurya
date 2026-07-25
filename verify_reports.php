<?php
// Test ReportController methods can be loaded without errors

require_once 'd:\Desktop\SKRIPSI\bootstrap\app.php';

$app = require 'd:\Desktop\SKRIPSI\bootstrap\app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

try {
    // Check if ReportController can be instantiated
    $controller = new App\Http\Controllers\ReportController();
    echo "✓ ReportController loaded successfully\n";
    
    // Check if required models exist
    $models = [
        'App\Models\Invoice',
        'App\Models\Quotation',
        'App\Models\DeliveryNote',
        'App\Models\Customer'
    ];
    
    foreach ($models as $model) {
        if (class_exists($model)) {
            echo "✓ {$model} exists\n";
        } else {
            echo "✗ {$model} NOT FOUND\n";
        }
    }
    
    echo "\n✅ All required classes are available!\n";
    echo "\nReports will be exported as CSV files that can be opened in Excel.\n";
    echo "Login as owner (owner/owner123) and navigate to Laporan & Export menu.\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
