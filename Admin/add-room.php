<?php
include 'dbc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $amenities = $_POST['amenities'];
    $other_amenities = $_POST['other_amenities'];
    $occupancy = $_POST['occupancy'];
    $size = $_POST['size'];
    $image_url = $_POST['image_url'];
    $price = $_POST['price'];

    $sql = "INSERT INTO rooms (name, category, description, amenities,other_amenities, occupancy, size,image_url, price) 
            VALUES ('$name', '$category', '$description', '$amenities','$other_amenities', '$occupancy', '$size','$image_url', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "Room added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
?>