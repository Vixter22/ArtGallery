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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $artist = $_POST['artist'];
    $image = $_POST['image'];
    $description = $_POST['description'];

    if (empty($title) || empty($category) || empty($artist) || empty($image) || empty($description)) {
        echo json_encode(['error' => 'All fields are required']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO paintings (title, category, artist, image, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $title, $category, $artist, $image, $description);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Failed to add painting']);
    }

    $stmt->close();
    $conn->close();
    exit;
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
