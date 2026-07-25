<?php
$conn = mysqli_connect('127.0.0.1', 'root', '', 'db_skripsi');

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Delete the fixed migration record
if (mysqli_query($conn, "DELETE FROM migrations WHERE migration = '2026_06_19_000001_create_payments_table_fixed'")) {
    echo "✓ Duplicate migration record deleted\n";
} else {
    echo "✗ Error: " . mysqli_error($conn) . "\n";
}

mysqli_close($conn);
