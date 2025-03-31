<?php
include 'dbc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $amenities = $_POST['amenities'];
    $other_amenities = $_POST['other_amenities'];
    $occupancy = $_POST['occupancy'];
    $size = $_POST['size'];
    $image_url = $_POST['image_url'];
    $price = $_POST['price'];

    $sql = "UPDATE rooms SET 
            name='$name', category='$category', description='$description',
            amenities='$amenities',other_amenities='$other_amenities', occupancy='$occupancy', size='$size',image_url='$image_url', price='$price'
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Room updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
?>
