<?php
include 'dbc.php';

if (isset($_GET['id'])) {
    $staffId = $_GET['id'];
    $sql = "SELECT * FROM staff WHERE id = $staffId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["error" => "Memeber not found"]);
    }
    $conn->close();
}
?>
