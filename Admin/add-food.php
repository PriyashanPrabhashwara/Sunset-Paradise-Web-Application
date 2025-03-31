<?php
include 'dbc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $description = $_POST['description'];

    $sql = "INSERT INTO foods (Category, name, category_id, quantity, price, image, description) 
            VALUES ('$category', '$name', '$category_id', '$quantity', '$price', '$image', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "New food item added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
