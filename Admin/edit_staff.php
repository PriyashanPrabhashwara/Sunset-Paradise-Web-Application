<?php
include 'dbc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Update staff details
    $sql = "UPDATE staff SET name='$name', email='$email', username='$username', password='$password' WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Staff details updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>