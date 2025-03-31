<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include 'dbc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id']) && isset($_POST['email'])) {
    $userID = $_POST['user_id'];
    $email = $_POST['email'];

    // Fetch Customer Name for Email
    $sql = "SELECT CustomerName FROM customers WHERE User_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $stmt->bind_result($customerName);
    $stmt->fetch();
    $stmt->close();

    // Delete User from Database
    $deleteSQL = "DELETE FROM customers WHERE User_ID = ?";
    $stmt = $conn->prepare($deleteSQL);
    $stmt->bind_param("i", $userID);
    
    if ($stmt->execute()) {
        sendEmailNotification($email, $customerName);
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
}

// Function to Send Email Notification
function sendEmailNotification($email, $customerName) {
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

        // Sender and Recipient
        $mail->setFrom('smjayanidesilva@gmail.com', 'Sunset Paradise');
        $mail->addAddress($email, $customerName);

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = "Account Removal Notification";
        $mail->Body    = "<p>Dear $customerName,</p>
                          <p>We regret to inform you that your account has been removed from our system.</p>
                          <p>If you have any questions, please contact us.</p>
                          <p>Best regards,<br>FitZone Fitness Center</p>";

        $mail->send();
    } catch (Exception $e) {
        error_log("Email not sent: {$mail->ErrorInfo}");
    }
}
?>
