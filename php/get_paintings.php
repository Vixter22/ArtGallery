<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Підключення до бази даних
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "artgallery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$category = isset($_GET['category']) ? $_GET['category'] : '';

// Виконуємо запит до бази даних
$sql = "SELECT * FROM paintings WHERE category='$category'";
$result = $conn->query($sql);

$paintings = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    // Додаємо повний шлях до зображень
    $row['image'] = 'http://localhost/artgallery/public' . $row['image'];
    $paintings[] = $row;
  }
} else {
  error_log("No paintings found for category: " . $category);
}

header('Content-Type: application/json');
echo json_encode($paintings);

$conn->close();
?>
