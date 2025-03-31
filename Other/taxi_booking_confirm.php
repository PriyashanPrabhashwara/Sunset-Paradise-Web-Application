<?php
session_start();
header("Content-Type: application/json");
include 'dbc.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Ensure user is logged in
if (!isset($_SESSION["user_id"])) {
    echo json_encode(["success" => false, "message" => "You must be logged in to book a ride!"]);
    exit();
}

$user_id = $_SESSION["user_id"];
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (!isset($data["destination"], $data["date"], $data["vehicle"], $data["fare"], $data["price"], $data["vehicle_image"])) {
    echo json_encode(["success" => false, "message" => "Missing required fields"]);
    exit();
}

$destination = $data["destination"];
$date = $data["date"];
$vehicle = $data["vehicle"];
$fare = $data["fare"];
$price = $data["price"];
$vehicle_image = $data["vehicle_image"];

// Check if the user has an active room booking
$stmt = $conn->prepare("SELECT * FROM bookings WHERE User_ID = ? AND departure_date >= CURDATE()");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["success" => false, "message" => "You must have an active room booking to reserve transport."]);
    exit();
}

// Get user email from customers table
$stmt = $conn->prepare("SELECT Email FROM customers WHERE User_ID = ?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo json_encode(["success" => false, "message" => "User not found"]);
    exit();
}

$email = $user["Email"];

// Insert booking into database
$stmt = $conn->prepare("INSERT INTO transport (User_ID, destination, date, vehicle, fare, vehicle_image) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $user_id, $destination, $date, $vehicle, $price, $vehicle_image);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
    sendBookingEmail($email, $destination, $date, $vehicle, $fare, $vehicle_image);
} else {
    echo json_encode(["success" => false, "message" => "Database error"]);
}

// Function to send booking confirmation email
function sendBookingEmail($email, $destination, $date, $vehicle, $fare, $vehicle_image) {
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->SMTPDebug=0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Use SMTP host (Gmail, Outlook, etc.)
        $mail->SMTPAuth = true;
        $mail->Username = 'smjayanidesilva@gmail.com'; 
        $mail->Password = 'gbnk rjln ziif vuvm'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom('smjayanidesilva@gmail.com', 'Sunset Paradise'); // Replace with your gym's name
        $mail->addAddress($email);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "Booking Confirmation";
        $mail->Body = "
            <html>
            <head>
                <title>Transport Booking Confirmation</title>
                <style>
                    body { font-family: Arial, sans-serif; color: #333; }
                    .container { text-align: center; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background: #f9f9f9; }
                    .vehicle-img { width: 150px; height: auto; margin-bottom: 15px; }
                    .highlight { font-size: 18px; font-weight: bold; color: #ff6600; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h2>Your Booking Details</h2>
                    <img src='$vehicle_image' alt='$vehicle' class='vehicle-img'>
                    <p><strong>From:</strong> Unawatuna, Sri Lanka</p>
                    <p><strong>To:</strong> $destination</p>
                    <p><strong>Date & Time:</strong> $date</p>
                    <p><strong>Vehicle:</strong> <span class='highlight'>$vehicle</span></p>
                    <p><strong>Fare:</strong> <span class='highlight'>$fare</span></p>
                    <br>
                    <p>Staff Will Notify you about driver avalibility soon</p>
                </div>
            </body>
            </html>
        ";

        // Send email
        $mail->send();
    } catch (Exception $e) {
        error_log("Mail Error: " . $mail->ErrorInfo);
    }
}
?>
