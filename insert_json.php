<?php
$conn = new mysqli("localhost", "root", "", "contibutors");

if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}

$json = file_get_contents("contributors.json");
$data = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("JSON ERROR: " . json_last_error_msg());
}

if (!is_array($data)) {
    die("Invalid JSON structure");
}

$sql = "INSERT INTO contibutor (
    uniqueId, name, details, role, profileImage,
    projects, certificateUrl, verificationUrl, date
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

foreach ($data as $c) {
    $projects = json_encode($c['projects']);

    $stmt->bind_param(
        "sssssssss",
        $c['uniqueId'],
        $c['name'],
        $c['details'],
        $c['role'],
        $c['profileImage'],
        $projects,
        $c['certificateUrl'],
        $c['verificationUrl'],
        $c['date']
    );

    $stmt->execute();
}

echo "✅ JSON inserted successfully";
?>
