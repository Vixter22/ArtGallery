<?php
// Додаємо заголовки CORS для всіх запитів
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Повертаємо 200 OK для CORS preflight запитів
    http_response_code(200);
    exit();
}

// Підключення до бази даних
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "artgallery_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$response = array();
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id) {
    // Виконуємо запит до бази даних для отримання інформації про художника за ID
    $sql = "SELECT id, name, bday, country, image, biography FROM artist WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
        // Додаємо повний шлях до зображень
        $response['image'] = 'http://localhost/artgallery/public/' . $response['image'];
    } else {
        error_log("No artist found with id: " . $id);
        $response['error'] = "No artist found";
    }
} else {
    // Виконуємо запит до бази даних для отримання списку художників
    $sql = "SELECT id, name, bday, country, image FROM artist";
    $result = $conn->query($sql);

    $artists = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Додаємо повний шлях до зображень
            $row['image'] = 'http://localhost/artgallery/public/' . $row['image'];
            $artists[] = $row;
        }
    } else {
        error_log("No artists found");
    }

    $response = $artists;
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
