<?php
session_start();
require 'db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare('SELECT * FROM admins WHERE username = ?');
    $stmt->execute([$username]);
    $admin = $stmt->fetch();
    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid credentials';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; background-color: #1a1a1a; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; color: #fff; }
        .login-container { background: #2a2a2a; padding: 40px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.3); width: 100%; max-width: 400px; text-align: center; }
        h2 { color: #D6A94E; margin-bottom: 20px; }
        input[type="text"], input[type="password"] { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #444; background: #333; color: #fff; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #D6A94E; color: white; border: none; padding: 12px 20px; width: 100%; border-radius: 4px; cursor: pointer; font-size: 16px; margin-top: 10px; font-weight: bold; }
        button:hover { background-color: #c5973b; }
        .error { color: #d9534f; margin-top: 15px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Digitactic Admin</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p class="error"> <?= htmlspecialchars($error) ?> </p>
    </div>
</body>
</html>
