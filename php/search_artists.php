<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "artgallery_db";

// Створення з'єднання
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка з'єднання
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Отримання пошукового запиту
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Підготовка SQL запиту
$sql = "SELECT id, name FROM artist WHERE name LIKE ?";
$stmt = $conn->prepare($sql);
$search = "%$query%";
$stmt->bind_param("s", $search);
$stmt->execute();
$result = $stmt->get_result();

$artists = [];

// Збір результатів
while ($row = $result->fetch_assoc()) {
    $artists[] = $row;
}

// Закриття з'єднання
$stmt->close();
$conn->close();

// Відправка результатів
echo json_encode($artists);
?>
