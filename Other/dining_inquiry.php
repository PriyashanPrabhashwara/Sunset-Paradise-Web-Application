<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $restaurant = htmlspecialchars($_POST['restaurant']);
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
    $guests = htmlspecialchars($_POST['guests']);
    $title = htmlspecialchars($_POST['title']);
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    include 'dbc.php';

    // Insert reservation into database
    $sql = "INSERT INTO inquiries (restaurant, inquiry_date, inquiry_time, title, first_name, last_name, email, phone, message, Gustes_No)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssi", $restaurant, $date, $time, $title, $first_name, $last_name, $email, $phone, $message, $guests);

    if ($stmt->execute()) {
        // Send email confirmation using PHPMailer
        $mail = new PHPMailer(true);

        try {
            // SMTP Configuration
            $mail->SMTPDebug=0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'smjayanidesilva@gmail.com'; 
            $mail->Password = 'gbnk rjln ziif vuvm'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email Details
            $mail->setFrom('smjayanidesilva@gmail.com', 'Sunset Paradise'); 
            $mail->addAddress($email, "$first_name $last_name"); 
            $mail->isHTML(true);
            $mail->Subject = "Restaurant Booking Confirmation - $restaurant";

            $mail->Body = "
                <h2>Restaurant Booking Confirmation</h2>
                <p>Dear $title $first_name $last_name,</p>
                <p>Thank you for your reservation at <strong>$restaurant</strong>. Here are your booking details:</p>
                <ul>
                    <li><strong>Restaurant:</strong> $restaurant</li>
                    <li><strong>Date:</strong> $date</li>
                    <li><strong>Time:</strong> $time</li>
                    <li><strong>Number of Guests:</strong> $guests</li>
                    <li><strong>Phone:</strong> $phone</li>
                </ul>
                <p>A fine Table will be reserved when you arrive at the restuarant. </p>
                <p>Best regards, <br> Sunset Paradise Reservations Team</p>
            ";

            $mail->send();
            echo "Reservation successful. A confirmation email has been sent.";
        } catch (Exception $e) {
            echo "Reservation saved, but email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
