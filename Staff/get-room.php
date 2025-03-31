<?php
include 'dbc.php';

if (isset($_GET['id'])) {
    $roomId = $_GET['id'];
    $sql = "SELECT * FROM rooms WHERE id = $roomId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["error" => "Room not found"]);
    }
    $conn->close();
}
?>
