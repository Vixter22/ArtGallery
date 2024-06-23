<?php
// Дозволити запити з будь-якого домену
header("Access-Control-Allow-Origin: *");
// Дозволити методи запитів, такі як POST
header("Access-Control-Allow-Methods: POST");
// Дозволити специфічні заголовки
header("Access-Control-Allow-Headers: Content-Type");

header('Content-Type: application/json');

// Налаштування підключення до бази даних
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "artgallery_db";

// Підключення до бази даних
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка підключення
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

// Отримання даних з POST-запиту
$data = json_decode(file_get_contents("php://input"));

// Перевірка наявності даних
if (isset($data->username) && isset($data->password)) {
    $username = $data->username;
    $password = $data->password;

    // Запит до бази даних
    $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    // Перевірка результату запиту
    if ($result->num_rows > 0) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Невірний логін або пароль"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Невірний логін або пароль"]);
}

// Закриття підключення
$conn->close();
?>
