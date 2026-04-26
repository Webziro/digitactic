<?php
$file = 'index.php';
$content = file_get_contents($file);

function audit($text, $name) {
    preg_match_all('/<div/i', $text, $o);
    preg_match_all('/<\/div>/i', $text, $c);
    $oc = count($o[0]);
    $cc = count($c[0]);
    printf("%-15s | Open: %3d | Close: %3d | %s\n", $name, $oc, $cc, ($oc == $cc ? "OK" : "!!! BAD !!!"));
}

$sections = [
    'Hero' => ['id="hero"', 'id="aboutUs"'],
    'About' => ['id="aboutUs"', 'id="featuredWorks"'],
    'Featured' => ['id="featuredWorks"', 'id="clients"'],
    'Clients' => ['id="clients"', 'id="services"'],
    'Services' => ['id="services"', 'id="impact"'],
    'Impact/Stats' => ['id="impact"', 'id="footer"'],
    'Footer' => ['id="footer"', '</html>']
];

echo "Section         | Open     | Close     | Status\n";
echo "----------------|----------|-----------|--------\n";
foreach ($sections as $name => $bounds) {
    $s = strpos($content, $bounds[0]);
    $e = strpos($content, $bounds[1], $s);
    if ($s !== false && $e !== false) {
        audit(substr($content, $s, $e - $s), $name);
    } else {
        echo "Missing: $name (" . ($s === false ? "start" : "end") . ")\n";
    }
}
?>



















