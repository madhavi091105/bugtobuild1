<?php
require_once "config.php";
$sql = "SELECT * FROM contibutor";
$result = $conn->query($sql);
$data = [];
while ($row = $result->fetch_assoc()) {
    $row['projects'] = json_decode($row['projects'], true);

    $data[] = $row;
}
header("Content-Type: application/json");
echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
