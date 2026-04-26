<?php
require_once 'db.php';
$result = $conn->query("SELECT section_key FROM editable_content");
while ($row = $result->fetch_assoc()) {
    echo $row['section_key'] . "\n";
}
?>








