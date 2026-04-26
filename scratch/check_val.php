<?php
require_once 'db.php';
$result = $conn->query("SELECT * FROM editable_content WHERE content LIKE '%3%'");
while ($row = $result->fetch_assoc()) {
    echo "Key: " . $row['section_key'] . " | Value: " . $row['content'] . "\n";
}
?>




