<!-- Local Host -->
<?php
// Database connection file
$host = '127.0.0.1';
$db   = 'digitatic_db'; // Change to your database name
$user = 'root'; // Default XAMPP user
$pass = '';

$conn = mysqli_init();
if (!$conn) {
    die('mysqli_init failed');
}

// 2 second timeout to prevent 40s page hangs
mysqli_options($conn, MYSQLI_OPT_CONNECT_TIMEOUT, 2);

@$conn->real_connect($host, $user, $pass, $db);

if ($conn->connect_error) {
    $conn = null;
}
?>