<?php
include 'dbc.php';

$activity_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$activity = null;

if ($activity_id > 0) {
    $stmt = $conn->prepare("SELECT * FROM activities WHERE id = ?");
    $stmt->bind_param("i", $activity_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $activity = $result->fetch_assoc();
    $stmt->close();
}
$conn->close();

if (!$activity) {
    echo "Activity not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($activity['name']) ?></title>
    <link rel="stylesheet" href="activity.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<section id="activity-detail">
        <h1><?= htmlspecialchars($activity['name']) ?></h1>
        <img src="<?= htmlspecialchars($activity['image_url']) ?>" alt="<?= htmlspecialchars($activity['name']) ?>">
        <div class="details">
            <p><i class="fas fa-info-circle icon"></i><strong>Description:</strong> <?= htmlspecialchars($activity['description']) ?></p>
            <p><i class="fas fa-clock icon"></i><strong>Schedule:</strong> <?= htmlspecialchars($activity['schedule']) ?></p>
            <p><i class="fas fa-map-marker-alt icon"></i><strong>Location:</strong> <?= htmlspecialchars($activity['location']) ?></p>
            <p><i class="fas fa-dollar-sign icon"></i><strong>Price:</strong> $<?= htmlspecialchars($activity['price']) ?></p>
            <p><i class="fas fa-hourglass-half icon"></i><strong>Duration:</strong> <?= htmlspecialchars($activity['duration']) ?></p>
            <p><i class="fas fa-exclamation-circle icon"></i><strong>Requirements:</strong> <?= htmlspecialchars($activity['requirements']) ?></p>
            <p><i class="fas fa-envelope icon"></i><strong>Contact Information:</strong> <?= htmlspecialchars($activity['contact_info']) ?></p>
            <p><i class="fas fa-star icon"></i><strong>Reviews:</strong> <?= htmlspecialchars($activity['reviews']) ?></p>
            <p><i class="fas fa-gift icon"></i><strong>Special Offers:</strong> <?= htmlspecialchars($activity['special_offers']) ?></p>
        </div>
    </section>
</body>
</html>