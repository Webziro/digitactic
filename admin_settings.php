<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

$admin_id = $_SESSION['admin_id'];
$success_msg = '';
$error_msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $error_msg = 'All fields are required.';
    } elseif ($new_password !== $confirm_password) {
        $error_msg = 'New passwords do not match.';
    } elseif (strlen($new_password) < 6) {
        $error_msg = 'New password must be at least 6 characters long.';
    } else {
        // Verify current password
        $stmt = $conn->prepare('SELECT password FROM admins WHERE id = ?');
        $stmt->bind_param('i', $admin_id);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        $stmt->close();

        if (password_verify($current_password, $hashed_password)) {
            // Update password
            $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_stmt = $conn->prepare('UPDATE admins SET password = ? WHERE id = ?');
            $update_stmt->bind_param('si', $new_hashed_password, $admin_id);
            if ($update_stmt->execute()) {
                $success_msg = 'Password updated successfully!';
            } else {
                $error_msg = 'Error updating password. Please try again.';
            }
            $update_stmt->close();
        } else {
            $error_msg = 'Current password is incorrect.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | Digitatic Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        :root {
            --primary: #000000;
            --sidebar-bg: #111111;
            --bg: #f4f7f6;
            --accent: #5e6c30;
            --text: #333;
            --border: #e0e0e0;
            --error: #cf2e2e;
            --success: #2e7d32;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            color: white;
            display: flex;
            flex-direction: column;
            padding: 2rem 1.5rem;
            position: fixed;
            height: 100vh;
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 3rem;
            letter-spacing: -0.5px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 0.8rem 1rem;
            color: #888;
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 0.5rem;
            transition: all 0.3s;
        }

        .nav-item i { margin-right: 10px; font-size: 20px; }
        .nav-item:hover, .nav-item.active {
            color: white;
            background: rgba(255,255,255,0.1);
        }

        .logout-btn {
            margin-top: auto;
            color: #ff4d4d;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 3rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
        }

        h2 { font-size: 1.8rem; font-weight: 600; }

        .card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            max-width: 500px;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #000;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group { margin-bottom: 1.5rem; }
        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #666;
            margin-bottom: 0.5rem;
        }

        input {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid var(--border);
            border-radius: 12px;
            font-family: inherit;
            font-size: 0.95rem;
            transition: border-color 0.3s;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .btn-save {
            background: var(--primary);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            justify-content: center;
        }

        .btn-save:hover { background: #333; transform: translateY(-2px); }

        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .alert-success { background: #e7f5ee; color: var(--success); border: 1px solid #c8e6c9; }
        .alert-error { background: #fff1f1; color: var(--error); border: 1px solid #ffebeb; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">DIGITATIC</div>
        <a href="admin_dashboard.php" class="nav-item"><i class="material-icons">dashboard</i> Content Manager</a>
        <a href="admin_settings.php" class="nav-item active"><i class="material-icons">settings</i> Settings</a>
        <a href="/" target="_blank" class="nav-item"><i class="material-icons">visibility</i> View Site</a>
        <a href="logout.php" class="nav-item logout-btn"><i class="material-icons">logout</i> Logout</a>
    </div>

    <div class="main-content">
        <div class="header">
            <div>
                <h2>Settings</h2>
                <p style="color: #666; margin-top: 4px;">Manage your account security.</p>
            </div>
        </div>

        <div class="card">
            <div class="card-title"><i class="material-icons">lock</i> Change Password</div>
            
            <?php if ($success_msg): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success_msg) ?></div>
            <?php endif; ?>

            <?php if ($error_msg): ?>
                <div class="alert alert-error"><?= htmlspecialchars($error_msg) ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="new_password" required minlength="6">
                </div>
                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" name="confirm_password" required minlength="6">
                </div>
                <button type="submit" class="btn-save">
                    <i class="material-icons">update</i> Update Password
                </button>
            </form>
        </div>
    </div>
</body>
</html>
