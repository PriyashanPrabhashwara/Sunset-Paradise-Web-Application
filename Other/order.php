<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    // Redirect to login page if not logged in
    
    header("Location: login.php");
    exit();
}
?>


<?php
include 'dbc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    
    // Get product details
    $sql = "SELECT name, price FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        $total_price = $product['price'] * $quantity;

        // Redirect to checkout page with order details
        header("Location: checkout.php?product_name=" . urlencode($product['name']) . "&quantity=" . $quantity . "&total_price=" . $total_price);
        exit();
    } else {
        echo "<p>Product not found.</p>";
    }

    $stmt->close();
}

$conn->close();
?>
