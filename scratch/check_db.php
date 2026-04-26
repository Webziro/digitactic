<?php
require_once 'db.php';
$result = $conn->query("SELECT * FROM editable_content WHERE section_key = 'stats_3_value'");
if ($result && $row = $result->fetch_assoc()) {
    echo "Key: " . $row['section_key'] . " | Value: " . $row['content'] . "\n";
} else {
    echo "Key not found\n";
}

$result = $conn->query("SELECT count(*) as count FROM editable_content");
$row = $result->fetch_assoc();
echo "Total rows: " . $row['count'] . "\n";
?>




















