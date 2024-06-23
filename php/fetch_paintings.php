<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "artgallery_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT paintings.id, paintings.title, category.name as category, artist.name as artist 
        FROM paintings 
        JOIN category ON paintings.category = category.id 
        JOIN artist ON paintings.artist = artist.id";
$result = $conn->query($sql);

$paintings = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $paintings[] = $row;
    }
} 

$conn->close();

echo json_encode($paintings);
?>
