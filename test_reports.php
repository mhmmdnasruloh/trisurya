<?php
$base = 'http://localhost:8000';

echo "Testing Reports Routes:\n\n";

// Test 1: Check if /reports route accessible
echo "1. Testing /reports page...\n";
$ch = curl_init("$base/reports");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_COOKIE, 'XSRF-TOKEN=test; laravel_session=test');
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
echo "   Status: $httpCode\n";
if ($httpCode === 403) {
    echo "   ✓ Expected 403 (Admin auth check)\n";
} elseif ($httpCode === 302) {
    echo "   ✓ Redirected (Likely auth redirect)\n";
} else {
    echo "   Check response...\n";
}

echo "\nNote: For full testing, access from browser as owner user\n";
echo "Reports page: $base/reports\n";
echo "Export Invoices: POST $base/reports/invoices/export\n";
echo "Export Quotations: POST $base/reports/quotations/export\n";
echo "Export Deliveries: POST $base/reports/deliveries/export\n";
