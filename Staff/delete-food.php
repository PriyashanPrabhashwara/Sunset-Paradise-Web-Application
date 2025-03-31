<?php
include 'dbc.php';

if (isset($_GET['id'])) {
    $foodId = $_GET['id'];
    $sql = "DELETE FROM foods WHERE id = $foodId";

    if ($conn->query($sql) === TRUE) {
        echo "Food Item deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
?>
