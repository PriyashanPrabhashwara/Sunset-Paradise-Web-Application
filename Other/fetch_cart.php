<?php
session_start();
include 'dbc.php';

if (!isset($_SESSION['user_id'])) {
    echo "<p>Please log in to view your cart.</p>";
    exit;
}

$user_id = $_SESSION['user_id'];
$cartQuery = $conn->query("SELECT * FROM user_cart WHERE User_ID = '$user_id'");

$cartTotal = 0; // Initialize total price

if ($cartQuery->num_rows > 0) {
    while ($row = $cartQuery->fetch_assoc()) {
        $subtotal = $row['price'] * $row['quantity'];
        $cartTotal += $subtotal;

        echo '<div class="cart-item" data-id="'.$row['food_id'].'">
                <img src="'.$row['image'].'" width="50">
                <div>
                    <strong>'.$row['name'].'</strong> <br>
                    Rs '.$row['price'].' x '.$row['quantity'].'
                </div>
                <button class="remove-item" data-id="'.$row['food_id'].'">X</button>
              </div>';
    }

    echo '<div class="cart-footer">Total: Rs <span id="cart-total">'.number_format($cartTotal, 2).'</span></div>';
} else {
    echo "<p>Your cart is empty.</p>";
}
?>

