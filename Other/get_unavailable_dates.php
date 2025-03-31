<?php
include 'dbc.php';

if (isset($_GET['room_name'])) {
    $room_name = $_GET['room_name'];
    $today = date('Y-m-d');

    // Only fetch bookings that are still valid
    $query = "SELECT arrival_date, departure_date FROM bookings WHERE room_name = ? AND departure_date >= ? AND status='Active'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $room_name, $today);
    $stmt->execute();
    $result = $stmt->get_result();

    $booked_dates = [];
    while ($row = $result->fetch_assoc()) {
        $start = new DateTime($row['arrival_date']);
        $end = new DateTime($row['departure_date']);

        while ($start <= $end) {
            $booked_dates[] = $start->format('Y-m-d');
            $start->modify('+1 day');
        }
    }

    echo json_encode($booked_dates);

    $stmt->close();
}
$conn->close();
?>
