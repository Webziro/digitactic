<?php
$conn = mysqli_connect('127.0.0.1', 'root', '', 'digitatic_db');
$result = mysqli_query($conn, "SELECT section_key, content FROM editable_content WHERE section_key IN ('hero_line_1', 'hero_line_2', 'hero_line_3')");
while($row = mysqli_fetch_assoc($result)) {
    echo $row['section_key'] . ": " . $row['content'] . "\n";
}
?>

