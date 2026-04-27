<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; background-color: #1a1a1a; margin: 0; padding: 40px; color: #fff; display: flex; flex-direction: column; align-items: center; }
        .dashboard-container { background: #2a2a2a; padding: 40px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.3); width: 100%; max-width: 600px; }
        h2 { color: #D6A94E; margin-bottom: 20px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        ul { list-style-type: none; padding: 0; }
        li { margin: 10px 0; }
        a { text-decoration: none; color: #fff; background: #333; display: block; padding: 15px; border-radius: 4px; transition: background 0.3s; border-left: 4px solid #D6A94E; font-weight: bold; }
        a:hover { background: #444; }
        .logout { margin-top: 20px; background: #d9534f; border-left: 4px solid #c9302c; text-align: center; }
        .logout:hover { background: #c9302c; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, Admin!</h2>
        <ul>
            <li><a href="edit_hero.php">Edit Hero Section</a></li>
            <li><a href="edit_who_we_are.php">Edit Who We Are Section</a></li>
            <li><a href="edit_about.php">Edit About Us Page</a></li>
            <li><a href="edit_impacts.php">Edit Impacts We Are Proud Of</a></li>
            <li><a href="logout.php" class="logout">Logout</a></li>
        </ul>
    </div>
</body>
</html>
