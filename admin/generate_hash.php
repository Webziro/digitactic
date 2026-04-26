<?php
// Run this script once to generate a password hash for the admin user
$password = 'Includeadmin@123';
$hash = password_hash($password, PASSWORD_DEFAULT);
echo $hash;
?>
















