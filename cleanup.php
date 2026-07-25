<?php
$conn = mysqli_connect('127.0.0.1', 'root', '', 'db_skripsi');

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Drop payments table
if (mysqli_query($conn, 'DROP TABLE IF EXISTS payments')) {
    echo "✓ Payments table dropped\n";
} else {
    echo "✗ Error dropping table: " . mysqli_error($conn) . "\n";
}

// Delete migration records
if (mysqli_query($conn, "DELETE FROM migrations WHERE migration LIKE '2026_06_19%'")) {
    echo "✓ Migration records deleted\n";
} else {
    echo "✗ Error deleting migrations: " . mysqli_error($conn) . "\n";
}

mysqli_close($conn);
echo "\nReady to run: php artisan migrate\n";
