<?php
include 'dbc.php';

if (isset($_GET['id'])) {
    $foodId = $_GET['id'];
    $sql = "SELECT * FROM foods WHERE id = $foodId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["error" => "food not found"]);
    }
    $conn->close();
}
?>
