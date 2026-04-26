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
<style>h1, h2, h3, h4, h5, h6, .elementor-heading-title, .pe--icon--caption { color: #fff !important; } p, .text-wrapper p, .elementor-widget-container p { color: #fff !important; font-size: 18px !important; } .page--loader--block, .page--transition--block, .container--bg, #process .bg--color, #services .bg--color, .elementor-button { background-color: #fff !important; } .loader--caption, .pe--scroll--button i, .pe--scroll--button .pe--icon--caption { color: #000 !important; } .loader--caption { font-weight: bold !important; font-size: 14px !important; text-transform: uppercase !important; letter-spacing: 2px !important; } .site-branding .site-logo img, .site-branding .sticky-logo img, .main__logo { height: 75px !important; width: auto !important; object-fit: contain !important; } .lead-popup-close { background: rgba(255, 255, 255, 0.1) !important; border-radius: 50% !important; }</style>
<style id='force-branding'>/* FORCE BRANDING OVERRIDE */ h1, h2, h3, h4, h5, h6, .elementor-heading-title, .elementor-widget-container span, .elementor-widget-container p, .elementor-widget-container a { color: #fff !important; } .elementor-button, .pb--handle, [class*='button'] { border-color: #fff !important; color: #fff !important; } .elementor-button:hover, .pb--handle:hover { background-color: #fff !important; color: #000 !important; } .page--loader--block, .page--transition--block, .container--bg, #process .bg--color, #services .bg--color, [style*='background-color: #ff'], [style*='background-color: #fc'] { background-color: #fff !important; } .loader--caption, .pe--scroll--button i, .pe--scroll--button .pe--icon--caption { color: #000 !important; } .site-branding .site-logo img, .site-branding .sticky-logo img, .main__logo { height: 75px !important; width: auto !important; object-fit: contain !important; }</style>
<style id='loading-fix'>.responsive-hero-title .customized--word, .responsive-hero-title .elementor-repeater-item-806b59e, .customized--word { color: #D6A94E !important; } .responsive-hero-title .customized--word *, .customized--word * { color: #D6A94E !important; } h1, h2, h3, h4, h5, h6, .elementor-heading-title, p, a, span:not(.customized--word) { color: #fff !important; } .page--loader--block, .page--transition--block, .container--bg, .page--loader, .page--transitions { background-color: #e5d3a1 !important; }</style>
</head>
<body>
    <h2>Admin Login</h2>
    <form method="post">
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <button type="submit">Login</button>
    </form>
    <p style="color:red;"> <?= htmlspecialchars($error) ?> </p>
</body>
</html>


















