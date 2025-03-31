<?php
session_start();
include 'dbc.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "User not logged in."]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);
$userId = $_SESSION['user_id'];
$fullName = $data['fullName'];
$email = $data['email'];
$password = $data['password'];
$phone = $data['phone'];

$sql = "UPDATE customers SET CustomerName = ?, Email = ?, Password = ?, Number = ? WHERE User_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $fullName, $email, $password, $phone, $userId);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Update failed."]);
}
?>
