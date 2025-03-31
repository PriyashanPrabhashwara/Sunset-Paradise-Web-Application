<?php
include 'dbc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $schedule = $_POST['schedule'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];
    $duration = $_POST['duration'];
    $requirements = $_POST['requirements'];
    $special_offers = $_POST['special_offers'];

    $sql = "INSERT INTO activities (name, description, schedule, location, price, image_url, duration, requirements, special_offers) 
            VALUES ('$name', '$description', '$schedule', '$location', '$price', '$image_url', '$duration', '$requirements', '$special_offers')";

    if ($conn->query($sql) === TRUE) {
        echo "Activity added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
