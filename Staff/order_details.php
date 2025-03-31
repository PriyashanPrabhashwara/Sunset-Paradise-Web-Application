<?php
include 'dbc.php';

$order_id = $_GET['order_id'];

// Get order details
$orderQuery = "SELECT * FROM orders WHERE order_id = ?";
$stmt = $conn->prepare($orderQuery);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$orderResult = $stmt->get_result()->fetch_assoc();

// Get order items
$itemQuery = "SELECT * FROM order_items WHERE order_id = ?";
$stmt = $conn->prepare($itemQuery);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$itemResult = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
    <style>
        /* General Page Styling */
body {
    font-family: 'Poppins', sans-serif;
    background: #f4f6f9;
    color: #333;
    margin: 0;
    padding: 20px;
    line-height: 1.6;
}

h2 {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #222;
}

h3 {
    font-size: 20px;
    font-weight: 600;
    margin-top: 20px;
    color: #333;
}

/* Order Details Styling */
p {
    font-size: 16px;
    margin: 8px 0;
    background: #fff;
    padding: 10px;
    border-radius: 6px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.08);
}

strong {
    color: #ff7b00;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
}

thead {
    background: #ff7b00;
    color: #fff;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    font-size: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

tr:hover {
    background: rgba(255, 123, 0, 0.1);
}

/* Image Styling */
td img {
    border-radius: 6px;
    width: 60px;
    height: auto;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
}

/* Back Button */
a {
    display: inline-block;
    padding: 10px 15px;
    font-size: 16px;
    font-weight: 500;
    color: #fff;
    background: #ff7b00;
    border-radius: 6px;
    text-decoration: none;
    margin-top: 20px;
    transition: 0.3s;
}

a:hover {
    background: #e06b00;
}

/* Responsive Design */
@media (max-width: 768px) {
    table {
        font-size: 14px;
    }

    th, td {
        padding: 10px;
    }

    p {
        font-size: 14px;
    }

    a {
        font-size: 14px;
    }
}

    </style>
</head>
<body>
    <h2>Order <?php echo $order_id; ?> Details</h2>
    <p><strong>Delivery Place:</strong> <?php echo $orderResult['Delivery_Place']; ?></p>
    <p><strong>Total Price:</strong> Rs <?php echo number_format($orderResult['total_price'], 2); ?></p>
    <p><strong>Payment Method:</strong> <?php echo $orderResult['payment_method']; ?></p>
    <p><strong>Status:</strong> <?php echo $orderResult['status']; ?></p>

    <h3>Ordered Items</h3>
    <table>
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($item = $itemResult->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $item['item_name']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>Rs <?php echo number_format($item['price'], 2); ?></td>
                    <td><img src="<?php echo $item['image_url']; ?>" width="50"></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="staff_orders.php">Back to Orders</a>
</body>
</html>
