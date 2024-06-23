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
    error_log("Connection failed: " . $conn->connect_error, 3, "php_error.log");
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    // Перевірка всіх необхідних полів
    $requiredFields = ['title', 'category', 'artist', 'image', 'description'];
    foreach ($requiredFields as $field) {
        if (!isset($data[$field])) {
            error_log("Missing field: " . $field, 3, "php_error.log");
            echo json_encode(["message" => "Failed to add painting: missing field " . $field]);
            exit;
        }
    }

    $title = $data['title'];
    $category = $data['category'];
    $artist = $data['artist'];
    $image = $data['image'];
    $description = $data['description'];

    $stmt = $conn->prepare("INSERT INTO paintings (title, category, artist, image, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $category, $artist, $image, $description);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Painting added successfully"]);
    } else {
        error_log("Database insert failed: " . $stmt->error, 3, "php_error.log");
        echo json_encode(["message" => "Failed to add painting"]);
    }

    $stmt->close();
} else {
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

    echo json_encode($paintings);
}

$conn->close();
?>
