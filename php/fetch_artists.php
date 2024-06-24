<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "artgallery_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array("error" => "Connection failed: " . $conn->connect_error)));
}

$sql = "SELECT id, name, bday, country FROM artist";
$result = $conn->query($sql);

$artists = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $artists[] = $row;
    }
}

$conn->close();

echo json_encode($artists);
?>
