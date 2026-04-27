<?php
/**
 * Database connection file
 * Auto-detects Local vs Live environment — no manual switching needed.
 */

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

$conn = mysqli_init();
if (!$conn) {
    die('mysqli_init failed');
}

// 2 second timeout to prevent page hangs
mysqli_options($conn, MYSQLI_OPT_CONNECT_TIMEOUT, 2);

// Connect to the database
@$conn->real_connect($host, $user, $pass, $db);

if ($conn->connect_error) {
    // If connection fails, set $conn to null so index.php handles it gracefully
    $conn = null;
}












