<?php
session_start();
include 'dbc.php';

if (!isset($_SESSION['user_id'])) {
    echo "Please log in to add items to the cart.";
    exit;
}

$user_id = $_SESSION['user_id'];
$food_id = $_POST['food_id'];
$name = $_POST['name'];
$price = $_POST['price'];
$image = $_POST['image'];
$quantity = $_POST['quantity'];

// Check if item already exists in cart
$checkQuery = $conn->query("SELECT * FROM user_cart WHERE User_ID = '$user_id' AND food_id = '$food_id'");
if ($checkQuery->num_rows > 0) {
    $conn->query("UPDATE user_cart SET quantity = quantity + $quantity WHERE User_ID = '$user_id' AND food_id = '$food_id'");
} else {
    $conn->query("INSERT INTO user_cart (User_ID, food_id, name, price, image, quantity) VALUES ('$user_id', '$food_id', '$name', '$price', '$image', '$quantity')");
    echo "Item successfully added";
}


?>
