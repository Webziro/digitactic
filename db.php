
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
    // If database fails, we just don't set $conn (index.php handles this gracefully)
    $conn = null;
}
?>


<!-- Live Host -->
<?php
// Database connection file
// $host = 'localhost'; 
// $db   = 'digiwfyi_digitact_digi'; 
// $user = 'digiwfyi_digi'; 
// $pass = 'Vg9t+pcU{)4(Gp]?'; 

// $conn = mysqli_init();
// if (!$conn) {
//     die('mysqli_init failed');
// }

// // 2 second timeout to prevent page hangs
// mysqli_options($conn, MYSQLI_OPT_CONNECT_TIMEOUT, 2);

// // Connect to the database
// @$conn->real_connect($host, $user, $pass, $db);

// if ($conn->connect_error) {
//     // If connection fails, set $conn to null so index.php knows to handle it gracefully
//     $conn = null;
// }


