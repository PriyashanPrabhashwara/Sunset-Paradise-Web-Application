<?php
include 'dbc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $category = $_POST['category'];
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $description = $_POST['description']; 

    // Debugging Output (Check if values are received)
    if (empty($id) || empty($name) || empty($price)) {
        echo "Missing required fields!";
        exit();
    }

    $sql = "UPDATE foods SET 
            Category='$category', 
            name='$name', 
            category_id='$category_id', 
            quantity='$quantity', 
            price='$price', 
            image='$image', 
            description='$description'
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Food Item updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
?>

