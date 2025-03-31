<?php
include 'dbc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $description = $_POST['description'];
    $name = $_POST['name'];
    $schedule = $_POST['schedule'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];
    $duration = $_POST['duration'];
    $requirements = $_POST['requirements'];
    $special_offers = $_POST['special_offers'];

    $sql = "UPDATE activities SET 
                name = '$name', 
                description = '$description',
                schedule = '$schedule', 
                location = '$location', 
                price = '$price', 
                image_url = '$image_url', 
                duration = '$duration', 
                requirements = '$requirements', 
                special_offers = '$special_offers'
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Activity updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
