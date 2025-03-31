<?php
session_start();
include 'dbc.php'; // Database connection

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$nameQuery ="SELECT * FROM customers WHERE User_ID = ?";
$stmt = $conn->prepare($nameQuery);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$nameResult = $stmt->get_result();

$name = $nameResult->fetch_assoc();

$roomQuery2 = "SELECT * FROM bookings WHERE User_ID = ?";
$stmt = $conn->prepare($roomQuery2);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$roomResult = $stmt->get_result();
$room = $roomResult->fetch_assoc();

$message = "";

// Handle Checkout Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'checkout') {
        // Handle Checkout Submission
        $place = $_POST['delivery_place'];
        $address = $_POST['address'];
        $payment_method = $_POST['payment_method'];

        if ($place == 'room') {
            // Check if the user has a reserved room
            $roomQuery = "SELECT * FROM bookings WHERE User_ID = ? AND departure_date >= CURDATE()";
            $stmt = $conn->prepare($roomQuery);
            $stmt->bind_param("s", $user_id);
            $stmt->execute();
            $roomResult = $stmt->get_result();

            if ($roomResult->num_rows == 0) {
                $message = "<span style='color: red;'>You haven't booked a room yet or your booking period is over. Please book a room. </span>";
            }

            else{
                // Retrieve cart items from the database
        $cartQuery = "SELECT * FROM user_cart WHERE user_id = ?";
        $stmt = $conn->prepare($cartQuery);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $cartResult = $stmt->get_result();

        if ($cartResult->num_rows > 0) {
            // Calculate total price
            $total_price = 0;
            $cart_items = [];
            while ($row = $cartResult->fetch_assoc()) {
                $total_price += $row['price'] * $row['quantity'];
                $cart_items[] = $row; // Store cart items
            }

            // Insert into `orders` table
            $orderQuery = "INSERT INTO orders (User_ID, Delivery_Place, address, total_price, payment_method, order_date) 
                           VALUES (?, ?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($orderQuery);
            $stmt->bind_param("sssss", $user_id, $place, $room['room_name'], $total_price, $payment_method);
            $stmt->execute();
            $order_id = $stmt->insert_id; // Get newly created order ID

            // Insert each item into `order_items` table
            foreach ($cart_items as $item) {
                $itemQuery = "INSERT INTO order_items (order_id, item_name, quantity, price, image_url) 
                              VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($itemQuery);
                $stmt->bind_param("isids", $order_id, $item['name'], $item['quantity'], $item['price'], $item['image']);
                $stmt->execute();

                // Reduce stock from `foods` table
                $updateStockQuery = "UPDATE foods SET quantity = quantity - ? WHERE name = ?";
                $stmt = $conn->prepare($updateStockQuery);
                $stmt->bind_param("is", $item['quantity'], $item['name']);
                $stmt->execute();
            }

            // Clear cart after checkout
            $clearCartQuery = "DELETE FROM user_cart WHERE User_ID = ?";
            $stmt = $conn->prepare($clearCartQuery);
            $stmt->bind_param("s", $user_id);
            $stmt->execute();

            $message = "Your order has been placed successfully!";
        } 
        
        else {
            $message = "Your cart is empty.";
        }
            }
        }

        else{

        // Retrieve cart items from the database
        $cartQuery = "SELECT * FROM user_cart WHERE user_id = ?";
        $stmt = $conn->prepare($cartQuery);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $cartResult = $stmt->get_result();

        if ($cartResult->num_rows > 0) {
            // Calculate total price
            $total_price = 0;
            $cart_items = [];
            while ($row = $cartResult->fetch_assoc()) {
                $total_price += $row['price'] * $row['quantity'];
                $cart_items[] = $row; // Store cart items
            }

            // Insert into `orders` table
            $orderQuery = "INSERT INTO orders (User_ID, Delivery_Place, address, total_price, payment_method, order_date) 
                           VALUES (?, ?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($orderQuery);
            $stmt->bind_param("sssss", $user_id, $place, $address, $total_price, $payment_method);
            $stmt->execute();
            $order_id = $stmt->insert_id; // Get newly created order ID

            // Insert each item into `order_items` table
            foreach ($cart_items as $item) {
                $itemQuery = "INSERT INTO order_items (order_id, item_name, quantity, price, image_url) 
                              VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($itemQuery);
                $stmt->bind_param("isids", $order_id, $item['name'], $item['quantity'], $item['price'], $item['image']);
                $stmt->execute();

                // Reduce stock from `foods` table
                $updateStockQuery = "UPDATE foods SET quantity = quantity - ? WHERE name = ?";
                $stmt = $conn->prepare($updateStockQuery);
                $stmt->bind_param("is", $item['quantity'], $item['name']);
                $stmt->execute();
            }

            // Clear cart after checkout
            $clearCartQuery = "DELETE FROM user_cart WHERE User_ID = ?";
            $stmt = $conn->prepare($clearCartQuery);
            $stmt->bind_param("s", $user_id);
            $stmt->execute();

            $message = "Your order has been placed successfully!";
        } else {
            $message = "Your cart is empty.";
        }
    }
    } 
}

 // fetch order details (only active)

 $sql = "SELECT o.order_id, o.address, o.total_price, o.payment_method, o.order_date, 
        o.status, oi.item_name, oi.quantity, oi.price, oi.image_url
        FROM orders o
        JOIN order_items oi ON o.order_id = oi.order_id
        WHERE o.User_ID = ?
        ORDER BY o.order_date DESC";


$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];

while ($row = $result->fetch_assoc()) {
    $orders[$row['order_id']]['details'] = [
        'order_id' => $row['order_id'],
        'address' => $row['address'],
        'total_price' => $row['total_price'],
        'payment_method' => $row['payment_method'],
        'order_date' => $row['order_date'],
        'status' => $row['status']
    ];
    $orders[$row['order_id']]['items'][] = [
        'item_name' => $row['item_name'],
        'quantity' => $row['quantity'],
        'price' => $row['price'],
        'image_url' => $row['image_url']
    ];
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar">
    <div class="nav-item"><i class="fas fa-phone-alt"></i> +94 77 123 4567</div>
    <div class="nav-item"><i class="fas fa-truck"></i> Delivery to Doorstep</div>
    <div class="nav-item"><i class="fas fa-bell"></i> Delivery to Room</div>
    <div class="nav-logo">Sunset Paradise</div>
    <div class="nav-item"><i class="fas fa-clock"></i> Operating hours: 9AM - 9PM daily</div>
</nav>

<section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">Gourmet Meals, Delivered to You</h1>
            <p class="hero-description">
                Experience the flavors of Sunset Paradise, whether you're relaxing in your luxury suite or enjoying a fine meal at home. Our world-class chefs craft exquisite dishes, delivered fresh to your doorstep or hotel room with exceptional service.
            </p>

            <!-- Delivery Options -->
            <div class="delivery-options">
                <div class="delivery-item">
                    <i class="fas fa-concierge-bell"></i>
                    <span>Room Delivery</span>
                </div>
                <div class="delivery-item">
                    <i class="fas fa-truck"></i>
                    <span>Home Delivery</span>
                </div>
            </div>

        
        </div>
    </section>

<div class="checkout-container">
        <?php if (!empty($message)) : ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>

        <form action="checkout.php" method="POST">

            <input type="hidden" name="action" value="checkout">
            
            <label for="delivery"><i class="fas fa-truck"></i> Delivery Place:</label>
            <select name="delivery_place" id="delivery" required>
                <option value="house">Deliver Order To Your Residency</option>
                <option value="room">Deliver Order To Your Room</option>
            </select>
            
            <div id="address-container">
                <label for="address" id="address-label"><i class="fas fa-map-marker-alt"></i> Address:</label>
                <textarea id="address" name="address" placeholder="Enter your delivery address..."></textarea>
            </div>

            <label for="payment"><i class="fas fa-credit-card"></i> Payment Method:</label>
            <select name="payment_method" id="payment" required>
                <option value="cash">Cash</option>
                <option value="card">Credit/Debit Card</option>
            </select>

            <button type="submit"><i class="fas fa-check-circle"></i> Confirm Order</button>
        </form>
    </div>
<br>
    <h2 class="orders-title">Your Orders</h2>

    <div class="orders-container">
    <?php if (!empty($orders)) : ?>
        <?php foreach ($orders as $order) : ?>
            <div class="order-box">
                <h3><i class="fas fa-receipt"></i> Order ID: <?php echo $order['details']['order_id']; ?></h3>
                <p><i class="fas fa-user"></i> <strong>Full Name:</strong> <?php echo $name['CustomerName'] ?></p>
                <p><i class="fas fa-map-marker-alt"></i> <strong>Delivery Place:</strong> <?php echo $order['details']['address']; ?></p>
                <p><i class="fas fa-wallet"></i> <strong>Payment:</strong> <?php echo ucfirst($order['details']['payment_method']); ?></p>
                <p><i class="fas fa-money-bill-wave"></i> <strong>Total Price:</strong> Rs <?php echo number_format($order['details']['total_price'], 2); ?></p>
                <p><i class="fas fa-calendar-alt"></i> <strong>Order Date:</strong> <?php echo $order['details']['order_date']; ?></p>
                <p><i class="fas fa-calendar-alt"></i> <strong>Order Status:</strong> <?php echo $order['details']['status']; ?></p>

                <h4><i class="fas fa-box"></i> Items Ordered:</h4>
                <ul class="items-list">
                    <?php foreach ($order['items'] as $item) : ?>
                        <li>
                            <img src="<?php echo $item['image_url']; ?>" alt="<?php echo $item['item_name']; ?>" class="item-image">
                            <?php echo $item['item_name']; ?> - <?php echo $item['quantity']; ?> x Rs <?php echo number_format($item['price'], 2); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>        
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p class="no-orders"><i class="fas fa-exclamation-circle"></i> No orders found.</p>
    <?php endif; ?>
</div>

<script>
        document.getElementById("delivery").addEventListener("change", function() {
            let addressContainer = document.getElementById("address-container");
            if (this.value === "house") {
                addressContainer.classList.remove("hidden");
                
            } else {
                addressContainer.classList.add("hidden");
                
            }
        });
    </script> 
</body>
</html>
