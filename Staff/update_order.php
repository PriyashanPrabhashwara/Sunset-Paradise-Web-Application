<?php
include 'dbc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $updateQuery = "UPDATE orders SET status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $status, $order_id);
    $stmt->execute();

    header("Location: staff_orders.php");
    exit();
}
?>
