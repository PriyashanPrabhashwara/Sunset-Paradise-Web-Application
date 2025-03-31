<?php
include 'dbc.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM activities WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Activity deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
