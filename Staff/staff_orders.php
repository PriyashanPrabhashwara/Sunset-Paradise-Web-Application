<?php
session_start();
include 'dbc.php'; // Database connection


// Fetch all orders
$orderQuery = "SELECT o.order_id, o.User_ID, o.address, o.total_price, o.payment_method,o.Delivery_Place, 
       DATE_FORMAT(o.order_date, '%Y-%m-%d') AS order_date, 
       DATE_FORMAT(o.order_date, '%H:%i:%s') AS order_time, 
       oi.item_name, oi.quantity, oi.price, oi.image_url, o.status
FROM orders o
JOIN order_items oi ON o.order_id = oi.order_id
ORDER BY o.order_date DESC;";

$orderResult = $conn->query($orderQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Orders - Staff Panel</title>
    <link rel="stylesheet" href="orders.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <?php include 'sidebar.php'; ?>
    
    <h2>Manage Orders</h2>

    <!-- Order Search Filter -->
    <input type="text" id="orderSearch" onkeyup="filterOrders()" placeholder="Search orders by ID, status, or customer...">

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Delivery Place</th>
                <th>Payment Method</th>
                <th>Total Price</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="orderTable">
            <?php while ($order = $orderResult->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['User_ID']; ?></td>
                    <td><?php echo $order['Delivery_Place']; ?></td>
                    <td><?php echo $order['payment_method']; ?></td>
                    <td>Rs <?php echo number_format($order['total_price'], 2); ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                    <td><?php echo $order['order_time']; ?></td>
                    <td>
                        <form action="update_order.php" method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                            <select name="status" onchange="this.form.submit()">
                                <option value="Pending" <?php if ($order['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                <option value="Processing" <?php if ($order['status'] == 'Processing') echo 'selected'; ?>>Processing</option>
                                <option value="Completed" <?php if ($order['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                                <option value="Cancelled" <?php if ($order['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                            </select>
                        </form>
                    </td>
                    <td><a href="order_details.php?order_id=<?php echo $order['order_id']; ?>">View Details</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script>
        function filterOrders() {
            let input = document.getElementById("orderSearch").value.toLowerCase();
            let rows = document.getElementById("orderTable").getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                let text = rows[i].textContent.toLowerCase();
                rows[i].style.display = text.includes(input) ? "" : "none";
            }
        }
    </script>
</body>
</html>
