<?php
include 'dbc.php';

if (isset($_GET['id'])) {
    $roomId = $_GET['id'];
    $sql = "DELETE FROM rooms WHERE id = $roomId";

    if ($conn->query($sql) === TRUE) {
        echo "Room deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
?>
