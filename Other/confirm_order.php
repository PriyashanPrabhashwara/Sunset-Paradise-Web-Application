<?php
include 'dbc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];

    $sql = "INSERT INTO orders (product_name, customer_name, email, quantity, total_price) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssid", $product_name, $customer_name, $email, $quantity, $total_price);

    if ($stmt->execute()) {
        echo "<h2>Thank you for your order, $customer_name!</h2>";
        echo "<p>Your order for $quantity x $product_name has been received. Total: $$total_price</p>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
