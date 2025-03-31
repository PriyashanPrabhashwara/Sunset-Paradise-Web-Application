<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include 'dbc.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"]; // Hash password

    // Insert data into database
    $sql = "INSERT INTO staff (name, email, username, password) VALUES ('$name', '$email', '$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        
        // Send welcome email
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug=0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Use SMTP host (Gmail, Outlook, etc.)
            $mail->SMTPAuth = true;
            $mail->Username = 'smjayanidesilva@gmail.com'; 
            $mail->Password = 'gbnk rjln ziif vuvm'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email content
            $mail->setFrom('smjayanidesilva@gmail.com', 'Sunset Paradise'); // Replace with your gym's name
            $mail->addAddress($email, $name);
            $mail->Subject = 'Welcome to Sunset Paradise';
            $mail->Body = "Hello $name,\n\nYou have been added as a staff member. Your username is: $username.Your password is: $password\n\nThank You!";

            $mail->send();
        } catch (Exception $e) {
            echo "Email sending failed: " . $mail->ErrorInfo;
        }

        echo "Staff member added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

