<?php
include 'dbc.php';

$id = $_GET['id'];
$roomQuery = $conn->query("SELECT * FROM rooms WHERE id = $id");
$room = $roomQuery->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $room['name'] ?></title>
    <<link rel="stylesheet" href="rooms.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="room-details-container">
    <img src="<?= $room['image_url'] ?>" alt="<?= $room['name'] ?>">
    <h2><?= $room['name'] ?></h2>
    <p><strong>Category:</strong> <?= $room['category'] ?></p>
    <p><strong>Occupancy:</strong> <?= $room['occupancy'] ?> Adults</p>
    <p><strong>Size:</strong> <?= $room['size'] ?></p>
    <p><strong>Amenities:</strong> <?= $room['amenities'] ?></p>
    <p><?= $room['description'] ?></p>

    <h2>Other Amenities</h2>
        <ul class="other-amenities-list">
            <?php
            $other_amenities = explode(',', $room['other_amenities']);
            foreach ($other_amenities as $amenity) {
                echo "<li>▶ $amenity</li>";
            }
            ?>
        </ul>
    <a href="booking.php?id=<?= $room['id'] ?>" class="btn book-btn">Book Now</a>
</div>

</body>
</html>
