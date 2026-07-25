<?php
// Load .env
$env_file = __DIR__ . '/.env';
if (file_exists($env_file)) {
    $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, 'DB_HOST') === 0) preg_match('/=(.*)/', $line, $m) && ($db_host = trim($m[1], '\'"'));
        if (strpos($line, 'DB_DATABASE') === 0) preg_match('/=(.*)/', $line, $m) && ($db_name = trim($m[1], '\'"'));
        if (strpos($line, 'DB_USERNAME') === 0) preg_match('/=(.*)/', $line, $m) && ($db_user = trim($m[1], '\'"'));
        if (strpos($line, 'DB_PASSWORD') === 0) preg_match('/=(.*)/', $line, $m) && ($db_pass = trim($m[1], '\'"'));
    }
}

$db_host = $db_host ?? '127.0.0.1';
$db_name = $db_name ?? 'db_skripsi';
$db_user = $db_user ?? 'root';
$db_pass = $db_pass ?? '';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    
    $pdo->exec("DROP TABLE IF EXISTS payments");
    echo "✓ Table 'payments' dropped successfully.\n";
} catch (PDOException $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
