<?php
session_start();
require 'db.php';
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

// Section keys
$sections = [
    'hero_line_1' => 'Hero Line 1',
    'hero_line_2' => 'Hero Line 2',
    'hero_line_3' => 'Hero Line 3',
    'hero_sub_part1' => 'Hero Subheadline Part 1',
    'hero_sub_part2' => 'Hero Subheadline Part 2',
    'who_we_are' => 'Who We Are (Index)',
    'about_us' => 'About Us Page',
    'services' => 'Services Page',
    'stats_1_value' => 'Stat 1 Value',
    'stats_1_label' => 'Stat 1 Label',
    'stats_2_value' => 'Stat 2 Value',
    'stats_2_label' => 'Stat 2 Label',
    'stats_3_value' => 'Stat 3 Value',
    'stats_3_label' => 'Stat 3 Label',
    'stats_4_value' => 'Stat 4 Value',
    'stats_4_label' => 'Stat 4 Label',
    'stats_5_value' => 'Stat 5 Value',
    'stats_5_label' => 'Stat 5 Label',
    'stats_6_value' => 'Stat 6 Value',
    'stats_6_label' => 'Stat 6 Label',
    'footer_phone' => 'Footer Phone'
];

$msg = $_SESSION['success_msg'] ?? '';
unset($_SESSION['success_msg']);

// Handle content update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($sections as $key => $label) {
        if (isset($_POST[$key])) {
            $content = trim($_POST[$key]);
            $stmt = $conn->prepare('INSERT INTO editable_content (section_key, content) VALUES (?, ?) ON DUPLICATE KEY UPDATE content = VALUES(content)');
            $stmt->bind_param('ss', $key, $content);
            $stmt->execute();
            $stmt->close();
        }
    }
    $_SESSION['success_msg'] = 'Content updated successfully!';
    header('Location: admin_dashboard.php');
    exit;
}

// Fetch current content
$contentData = [];
foreach ($sections as $key => $label) {
    $stmt = $conn->prepare('SELECT content FROM editable_content WHERE section_key = ?');
    $stmt->bind_param('s', $key);
    $stmt->execute();
    $stmt->bind_result($content);
    $stmt->fetch();
    $contentData[$key] = $content;
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Digitatic Admin</title>
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

        .btn-action {
            padding: 0.8rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-view { background: white; color: var(--primary); border: 1px solid var(--border); }
        .btn-save { background: var(--primary); color: white; }
        .btn-save:hover { background: #333; transform: translateY(-2px); }

        /* Form Sections */
        .card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            margin-bottom: 2rem;
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

        textarea {
            width: 100%;
            min-height: 80px;
            padding: 1rem;
            border: 1px solid var(--border);
            border-radius: 12px;
            font-family: inherit;
            font-size: 0.95rem;
            resize: vertical;
            transition: border-color 0.3s;
        }

        textarea:focus {
            outline: none;
            border-color: var(--primary);
        }

        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            font-weight: 500;
            animation: fadeIn 0.5s;
        }

        .alert-success { background: #e7f5ee; color: #2e7d32; border: 1px solid #c8e6c9; }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        /* Grid for categorization */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
        }
    </style>

<style>.site-branding, .site-logo, .site-logo a, .elementor-widget-pesitelogo { width: auto !important; max-width: none !important; min-width: max-content !important; overflow: visible !important; flex-shrink: 0 !important; } .site-branding .site-logo img, .site-branding .sticky-logo img, .main__logo { height: 75px !important; width: auto !important; max-width: none !important; max-height: none !important; object-fit: contain !important; }.pe--scroll--button i, .pe--scroll--button .pe--icon--caption { color: #000 !important; }
.loader--caption { color: #000 !important; font-weight: bold !important; font-size: 15px !important; text-transform: uppercase !important; letter-spacing: 2px !important; }
</style>
<style id='loading-fix'>.responsive-hero-title .customized--word, .responsive-hero-title .elementor-repeater-item-806b59e, .customized--word { color: #D6A94E !important; } .responsive-hero-title .customized--word *, .customized--word * { color: #D6A94E !important; } h1, h2, h3, h4, h5, h6, .elementor-heading-title, p, a, span:not(.customized--word) { color: #fff !important; } .page--loader--block, .page--transition--block, .container--bg, .page--loader, .page--transitions { background-color: #e5d3a1 !important; }</style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">DIGITATIC</div>
        <a href="#" class="nav-item active"><i class="material-icons">dashboard</i> Content Manager</a>
        <a href="./" target="_blank" class="nav-item"><i class="material-icons">visibility</i> View Site</a>
        <a href="logout.php" class="nav-item logout-btn"><i class="material-icons">logout</i> Logout</a>
    </div>

    <div class="main-content">
        <div class="header">
            <div>
                <h2>Content Management</h2>
                <p style="color: #666; margin-top: 4px;">Update your website content in real-time.</p>
            </div>
            <div class="actions">
                <a href="./" target="_blank" class="btn-action btn-view">
                    <i class="material-icons">launch</i> Live Preview
                </a>
            </div>
        </div>

        <?php if ($msg): ?>
            <div class="alert alert-success" id="success-alert">
                <i class="material-icons" style="vertical-align: middle; font-size: 18px; margin-right: 5px;">check_circle</i>
                <?= htmlspecialchars($msg) ?>
            </div>
            <script>
                setTimeout(function() {
                    var alert = document.getElementById('success-alert');
                    if (alert) {
                        alert.style.transition = 'opacity 0.5s ease';
                        alert.style.opacity = '0';
                        setTimeout(function() { alert.remove(); }, 500);
                    }
                }, 3000);
            </script>
        <?php endif; ?>

        <form method="post">
            <div class="form-grid">
                <!-- Hero Section Card -->
                <div class="card">
                    <div class="card-title"><i class="material-icons">rocket_launch</i> Hero Section</div>
                    <div class="form-group">
                        <label>Headline Line 1</label>
                        <textarea name="hero_line_1"><?= htmlspecialchars($contentData['hero_line_1'] ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Headline Line 2 (Highlighted)</label>
                        <textarea name="hero_line_2"><?= htmlspecialchars($contentData['hero_line_2'] ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Headline Line 3</label>
                        <textarea name="hero_line_3"><?= htmlspecialchars($contentData['hero_line_3'] ?? '') ?></textarea>
                    </div>
                </div>

                <!-- Sub-Hero Section Card -->
                <div class="card">
                    <div class="card-title"><i class="material-icons">subtitles</i> Hero Description</div>
                    <div class="form-group">
                        <label>Subheadline Part 1 (Engineering...)</label>
                        <textarea name="hero_sub_part1"><?= htmlspecialchars($contentData['hero_sub_part1'] ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Subheadline Part 2 (for the world's...)</label>
                        <textarea name="hero_sub_part2"><?= htmlspecialchars($contentData['hero_sub_part2'] ?? '') ?></textarea>
                    </div>
                </div>

                <!-- Impact Statistics Card -->
                <div class="card">
                    <div class="card-title"><i class="material-icons">leaderboard</i> Impact Statistics</div>
                    <div class="form-grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label>Stat 1 Value (e.g. 40)</label>
                            <input type="text" name="stats_1_value" value="<?= htmlspecialchars($contentData['stats_1_value'] ?? '40') ?>" style="width:100%; padding:0.8rem; border:1px solid var(--border); border-radius:10px;">
                        </div>
                        <div class="form-group">
                            <label>Stat 1 Label</label>
                            <input type="text" name="stats_1_label" value="<?= htmlspecialchars($contentData['stats_1_label'] ?? 'Project Completed') ?>" style="width:100%; padding:0.8rem; border:1px solid var(--border); border-radius:10px;">
                        </div>
                        
                        <div class="form-group">
                            <label>Stat 2 Value (e.g. 96)</label>
                            <input type="text" name="stats_2_value" value="<?= htmlspecialchars($contentData['stats_2_value'] ?? '96') ?>" style="width:100%; padding:0.8rem; border:1px solid var(--border); border-radius:10px;">
                        </div>
                        <div class="form-group">
                            <label>Stat 2 Label</label>
                            <input type="text" name="stats_2_label" value="<?= htmlspecialchars($contentData['stats_2_label'] ?? 'Satisfied Clients') ?>" style="width:100%; padding:0.8rem; border:1px solid var(--border); border-radius:10px;">
                        </div>

                        <div class="form-group">
                            <label>Stat 3 Value (e.g. 8)</label>
                            <input type="text" name="stats_3_value" value="<?= htmlspecialchars($contentData['stats_3_value'] ?? '8') ?>" style="width:100%; padding:0.8rem; border:1px solid var(--border); border-radius:10px;">
                        </div>
                        <div class="form-group">
                            <label>Stat 3 Label</label>
                            <input type="text" name="stats_3_label" value="<?= htmlspecialchars($contentData['stats_3_label'] ?? 'Running Projects') ?>" style="width:100%; padding:0.8rem; border:1px solid var(--border); border-radius:10px;">
                        </div>

                        <div class="form-group">
                            <label>Stat 4 Value (e.g. 96)</label>
                            <input type="text" name="stats_4_value" value="<?= htmlspecialchars($contentData['stats_4_value'] ?? '96') ?>" style="width:100%; padding:0.8rem; border:1px solid var(--border); border-radius:10px;">
                        </div>
                        <div class="form-group">
                            <label>Stat 4 Label</label>
                            <input type="text" name="stats_4_label" value="<?= htmlspecialchars($contentData['stats_4_label'] ?? 'Customer Satisfaction') ?>" style="width:100%; padding:0.8rem; border:1px solid var(--border); border-radius:10px;">
                        </div>

                        <div class="form-group">
                            <label>Stat 5 Value (e.g. 7)</label>
                            <input type="text" name="stats_5_value" value="<?= htmlspecialchars($contentData['stats_5_value'] ?? '7') ?>" style="width:100%; padding:0.8rem; border:1px solid var(--border); border-radius:10px;">
                        </div>
                        <div class="form-group">
                            <label>Stat 5 Label</label>
                            <input type="text" name="stats_5_label" value="<?= htmlspecialchars($contentData['stats_5_label'] ?? 'Years in Business') ?>" style="width:100%; padding:0.8rem; border:1px solid var(--border); border-radius:10px;">
                        </div>

                        <div class="form-group">
                            <label>Stat 6 Value (e.g. 7)</label>
                            <input type="text" name="stats_6_value" value="<?= htmlspecialchars($contentData['stats_6_value'] ?? '7') ?>" style="width:100%; padding:0.8rem; border:1px solid var(--border); border-radius:10px;">
                        </div>
                        <div class="form-group">
                            <label>Stat 6 Label</label>
                            <input type="text" name="stats_6_label" value="<?= htmlspecialchars($contentData['stats_6_label'] ?? 'Number of Team') ?>" style="width:100%; padding:0.8rem; border:1px solid var(--border); border-radius:10px;">
                        </div>
                    </div>
                </div>

                <!-- About & Services Card -->
                <div class="card">
                    <div class="card-title"><i class="material-icons">info</i> Page Content</div>
                    <div class="form-group">
                        <label>Who We Are (Homepage Section)</label>
                        <textarea name="who_we_are"><?= htmlspecialchars($contentData['who_we_are'] ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>About Us Page Content</label>
                        <textarea name="about_us"><?= htmlspecialchars($contentData['about_us'] ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Services Page Content</label>
                        <textarea name="services"><?= htmlspecialchars($contentData['services'] ?? '') ?></textarea>
                    </div>
                </div>

                <!-- Footer Card -->
                <div class="card">
                    <div class="card-title"><i class="material-icons">contact_support</i> Footer Details</div>
                    <div class="form-group">
                        <label>Footer Phone Number</label>
                        <input type="text" name="footer_phone" value="<?= htmlspecialchars($contentData['footer_phone'] ?? '+91 (154) 485 12 485') ?>" style="width:100%; padding:0.8rem; border:1px solid var(--border); border-radius:10px;">
                    </div>
                </div>
            </div>

            <div style="position: sticky; bottom: 2rem; background: rgba(244,247,246,0.8); backdrop-filter: blur(10px); padding: 1rem 0; text-align: right;">
                <button type="submit" class="btn-action btn-save">
                    <i class="material-icons">save</i> Save All Changes
                </button>
            </div>
        </form>
    </div>
</body>
</html>





















