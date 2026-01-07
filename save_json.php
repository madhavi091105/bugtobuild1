<?php
$jsonUrl = "https://contributors.bug2build.in/contributors.json";
$jsonData = file_get_contents($jsonUrl);

if ($jsonData === false) {
    die("Failed to fetch JSON");
}

file_put_contents("contributors.json", $jsonData);
echo "JSON link successfully converted into file!";
?>
