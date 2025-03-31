<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include 'dbc.php'; // Database connection

header("Content-Type: application/json");
ob_start(); // Prevents PHP warnings from breaking JSON response

$data = json_decode(file_get_contents("php://input"), true);
if (!$data || !isset($data["userId"], $data["bookingId"])) {
    echo json_encode(["success" => false, "message" => "Invalid request data"]);
    exit;
}

$userId = $data["userId"];
$bookingId = $data["bookingId"];

// Fetch user email from database
$stmt = $conn->prepare("SELECT Email FROM customers WHERE User_ID = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo json_encode(["success" => false, "message" => "User not found."]);
    exit;
}

$user = $result->fetch_assoc();
$email = $user["Email"];
$stmt->close();

$mail = new PHPMailer(true);
try {
    $mail->SMTPDebug = 0; // Change to 0 in production to disable debug output
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'smjayanidesilva@gmail.com'; 
    $mail->Password = 'gbnk rjln ziif vuvm'; // Ensure this is an App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Ensure sender is the verified Gmail account
    $mail->setFrom($mail->Username, 'Sunset Paradise');
    $mail->addAddress($email);

    if ($data["available"]) {
        $driverName = $data["driverName"];
        $arrivalTime = $data["arrivalTime"];
        $driverContact = $data["driverContact"];

        $mail->Subject = "Your Transport Booking - Driver Assigned";
        $mail->Body = "Dear Customer,\n\nYour driver details for Booking #$bookingId:\n\nDriver: $driverName\nEstimated Arrival: $arrivalTime\nContact: $driverContact\n\nThank you!";
    } else {
        $mail->Subject = "Your Transport Booking - No Driver Available";
        $mail->Body = "Dear Customer,\n\nWe regret to inform you that no drivers are available for Booking #$bookingId at this moment. We will notify you once one becomes available.\n\nThank you!";
    }

    if ($mail->send()) {
        ob_end_clean(); // Clears unwanted output
        echo json_encode(["success" => true, "message" => "Email Sent"]);
    } else {
        ob_end_clean();
        echo json_encode(["success" => false, "message" => "Email failed to send. Error: " . $mail->ErrorInfo]);
    }
} catch (Exception $e) {
    error_log("PHPMailer Error: " . $mail->ErrorInfo);
    ob_end_clean();
    echo json_encode(["success" => false, "message" => "Email could not be sent. Check server logs."]);
}
?>
