<?php
session_start();
include 'dbc.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false]);
    exit();
}

$userId = $_SESSION['user_id'];

$sql = "SELECT CustomerName, Email, Number, Password FROM customers WHERE User_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode([
        "success" => true,
        "fullName" => $row['CustomerName'],
        "email" => $row['Email'],
        "password" => $row['Password'],
        "phone" => $row['Number']
    ]);
} else {
    echo json_encode(["success" => false]);
}
?>
