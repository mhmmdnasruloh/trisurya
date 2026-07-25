<?php
$dotenv = [];
foreach (file('.env') as $line) {
    if (preg_match('/^([A-Z_]+)=(.*)$/', trim($line), $m)) {
        $dotenv[$m[1]] = trim($m[2], "\"'");
    }
}
$pdo = new PDO(
    'mysql:host='.$dotenv['DB_HOST'].';port='.$dotenv['DB_PORT'].';dbname='.$dotenv['DB_DATABASE'].';charset=utf8mb4',
    $dotenv['DB_USERNAME'],
    $dotenv['DB_PASSWORD'],
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);
$sql = "SELECT TABLE_NAME,COLUMN_NAME,COLUMN_TYPE,IS_NULLABLE,COLUMN_KEY,EXTRA FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=? AND TABLE_NAME IN ('payments','invoices') ORDER BY TABLE_NAME,COLUMN_NAME";
$stmt = $pdo->prepare($sql);
$stmt->execute([$dotenv['DB_DATABASE']]);
foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    echo implode('|', $row)."\n";
}
echo "---FK---\n";
$sql2 = "SELECT CONSTRAINT_NAME,TABLE_NAME,COLUMN_NAME,REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA=? AND TABLE_NAME='payments' AND REFERENCED_TABLE_NAME IS NOT NULL";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute([$dotenv['DB_DATABASE']]);
foreach ($stmt2->fetchAll(PDO::FETCH_ASSOC) as $row) {
    echo implode('|', $row)."\n";
}
