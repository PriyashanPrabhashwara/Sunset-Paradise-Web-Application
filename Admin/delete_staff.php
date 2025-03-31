<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include 'dbc.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Get staff details before deleting
    $query = "SELECT name, email FROM staff WHERE id = '$id'";
    $result = $conn->query($query);
    $staff = $result->fetch_assoc();
    
    if ($staff) {
        $name = $staff['name'];
        $email = $staff['email'];

        // Delete staff from database
        $sql = "DELETE FROM staff WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
            
            // Send email notification
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
                $mail->Subject = 'Account Deletion';
                $mail->Body = "Hello $name,\n\nYour staff account has been removed. If you not aware please contact admin.\n\nBest regards, Sunset Paradise.";

                $mail->send();
            } catch (Exception $e) {
                echo "Email sending failed: " . $mail->ErrorInfo;
            }

            echo "Staff member deleted successfully!";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Staff member not found!";
    }
}
?>
