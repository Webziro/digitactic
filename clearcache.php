<?php
// One-time cache clearing script - DELETE after use
$cleared = [];
$errors = [];

// 1. Clear OPcache (PHP opcode cache)
if (function_exists('opcache_reset')) {
    if (opcache_reset()) {
        $cleared[] = 'OPcache reset successfully';
    } else {
        $errors[] = 'OPcache reset failed';
    }
} else {
    $errors[] = 'OPcache not available';
}

// 2. Clear APC cache (alternative opcode cache)
if (function_exists('apc_clear_cache')) {
    apc_clear_cache();
    apc_clear_cache('user');
    $cleared[] = 'APC cache cleared';
}

// 3. Touch index.php to force recompile
$indexFile = __DIR__ . '/index.php';
if (touch($indexFile)) {
    $cleared[] = 'index.php touched (forced recompile)';
} else {
    $errors[] = 'Could not touch index.php';
}

// 4. Output result
echo '<h2>Cache Clear Results</h2>';
echo '<h3 style="color:green">Cleared:</h3><ul>';
foreach ($cleared as $msg) echo "<li>$msg</li>";
echo '</ul>';

if ($errors) {
    echo '<h3 style="color:orange">Not Available / Errors:</h3><ul>';
    foreach ($errors as $msg) echo "<li>$msg</li>";
    echo '</ul>';
}

echo '<p><strong>Done!</strong> Now visit <a href="/">the homepage</a> and hard refresh (Ctrl+F5).</p>';
echo '<p style="color:red"><strong>⚠️ DELETE this file (clearcache.php) after use for security!</strong></p>';
?>
