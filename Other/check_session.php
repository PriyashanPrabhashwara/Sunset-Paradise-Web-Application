<?php
session_start();
$response = ["loggedIn" => false, "userId" => ""];

if (isset($_SESSION['user_id'])) {
    $response["loggedIn"] = true;
    $response["userId"] = $_SESSION['user_id'];
}

echo json_encode($response);
?>