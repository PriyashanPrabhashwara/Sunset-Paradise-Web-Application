<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include 'dbc.php'; // Database connection

$roomname=$_SESSION['roomname'];
$total_price=$_SESSION['Total'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug=0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Use SMTP host (Gmail, Outlook, etc.)
            $mail->SMTPAuth = true;
            $mail->Username = 'smjayanidesilva@gmail.com'; // Replace with your email
            $mail->Password = 'gbnk rjln ziif vuvm'; // Replace with your App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email content
            $mail->setFrom('smjayanidesilva@gmail.com', 'Cinonaman Resort'); // Replace with your gym's name
            $mail->addAddress($email);
            $mail->Subject = 'Room Bokking confirmation';
            $mail->Body = "";

            if ($mail->send()) {
                header("Location: verify_email.php"); // Redirect to verification page
                exit();
            } else {
                $message = "Error sending verification email.";
            }
        } catch (Exception $e) {
            $message = "Mailer Error: {$mail->ErrorInfo}";
        }
}
?>