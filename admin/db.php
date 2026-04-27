<?php
// Database connection settings - Auto-detects Local vs Live
$isLive = isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'digitactic.net') !== false;

if ($isLive) {
    /* --- LIVE HOST (PRODUCTION) --- */
    $host = 'localhost';
    $db   = 'digiwfyi_digitact_digi';
    $user = 'digiwfyi_digi';
    $pass = 'Vg9t+pcU{)4(Gp]?';
} else {
    /* --- LOCAL HOST (XAMPP) --- */
    $host = '127.0.0.1';
    $db   = 'digitatic_db';
    $user = 'root';
    $pass = '';
}
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
?>
















