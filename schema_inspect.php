<?php
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
$host = $_ENV['DB_HOST'] ?? '127.0.0.1';
$port = $_ENV['DB_PORT'] ?? '3306';
dbname: $db = $_ENV['DB_DATABASE'] ?? '';
$user = $_ENV['DB_USERNAME'] ?? 'root';
$pass = $_ENV['DB_PASSWORD'] ?? '';
$dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', $host, $port, $db);
$pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$tables = $pdo->query("SELECT TABLE_NAME FROM information_schema.tables WHERE TABLE_SCHEMA = '" . $db . "' ORDER BY TABLE_NAME")->fetchAll(PDO::FETCH_COLUMN);
foreach ($tables as $table) {
    echo "TABLE: $table\n";
    $cols = $pdo->query("SELECT COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE, COLUMN_KEY, EXTRA FROM information_schema.columns WHERE TABLE_SCHEMA = '" . $db . "' AND TABLE_NAME = '" . $table . "' ORDER BY ORDINAL_POSITION")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($cols as $col) {
        echo "  - {$col['COLUMN_NAME']} ({$col['COLUMN_TYPE']}) nullable={$col['IS_NULLABLE']} key={$col['COLUMN_KEY']} extra={$col['EXTRA']}\n";
    }
    $fks = $pdo->query("SELECT COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM information_schema.key_column_usage WHERE TABLE_SCHEMA = '" . $db . "' AND TABLE_NAME = '" . $table . "' AND REFERENCED_TABLE_NAME IS NOT NULL")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($fks as $fk) {
        echo "  -> FK: {$fk['COLUMN_NAME']} references {$fk['REFERENCED_TABLE_NAME']}({$fk['REFERENCED_COLUMN_NAME']})\n";
    }
    echo "\n";
}
