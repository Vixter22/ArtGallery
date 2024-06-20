<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Requested-With");

// Підключення до бази даних
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "artgallery_db"; // змінено назву бази даних

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array("error" => "Connection failed: " . $conn->connect_error)));
}

// Оновлений SQL-запит для отримання даних про художників
$sql = "SELECT a.name, a.bday, a.country, a.image, a.biography 
        FROM artist a";
$result = $conn->query($sql);

$response = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
} else {
    error_log("No artists found");
    $response['error'] = "No artists found";
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
