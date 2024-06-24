<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Додаємо цей заголовок для вирішення проблеми CORS

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "artgallery_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$sql = "SELECT id, name, description FROM category";
$result = $conn->query($sql);

$categories = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
} else {
    echo json_encode(["message" => "No categories found"]);
    exit();
}

echo json_encode($categories);

$conn->close();
?>
