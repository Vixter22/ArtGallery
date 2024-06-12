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

// Перевіряємо наявність параметра id або category
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$category = isset($_GET['category']) ? $_GET['category'] : '';

$response = array();

if ($id) {
  // Виконуємо запит до бази даних для отримання картини за ID
  $sql = "SELECT * FROM paintings WHERE id = $id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $response = $result->fetch_assoc();
    // Додаємо повний шлях до зображень
    $response['image'] = 'http://localhost/artgallery/public' . $response['image'];
  } else {
    error_log("No painting found with id: " . $id);
    $response['error'] = "No painting found";
  }
} elseif ($category) {
  // Виконуємо запит до бази даних для отримання картин за категорією
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

  $response = $paintings;
} else {
  $response['error'] = "Invalid request";
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
