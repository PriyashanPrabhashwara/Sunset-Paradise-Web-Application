<?php
session_start();
include 'dbc.php';

if (!isset($_SESSION['user_id'])) {
    echo "Please log in.";
    exit;
}

$user_id = $_SESSION['user_id'];
$food_id = $_POST['food_id'];

$conn->query("DELETE FROM user_cart WHERE User_ID = '$user_id' AND food_id = '$food_id'");

echo "Item removed successfully!";
?>
