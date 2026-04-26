<?php
/**
 * Database connection file
 * Switch between Local and Live hosting by commenting/uncommenting the sections below.
 */

/* --- LOCAL HOST (XAMPP) --- */
$host = '127.0.0.1';
$db   = 'digitatic_db'; 
$user = 'root'; 
$pass = '';

/* --- LIVE HOST (PRODUCTION) --- 
$host = 'localhost'; 
$db   = 'digiwfyi_digitact_digi'; 
$user = 'digiwfyi_digi'; 
$pass = 'Vg9t+pcU{)4(Gp]?'; 
*/

$conn = mysqli_init();
if (!$conn) {
    die('mysqli_init failed');
}

// 2 second timeout to prevent page hangs
mysqli_options($conn, MYSQLI_OPT_CONNECT_TIMEOUT, 2);

// Connect to the database
@$conn->real_connect($host, $user, $pass, $db);

if ($conn->connect_error) {
    // If connection fails, set $conn to null so index.php knows to handle it gracefully
    $conn = null;
}
?>












