<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php'; // Include PHPMailer autoload file

include 'dbc.php';
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_code = $_POST['verification_code'];
    if ($entered_code == $_SESSION['verification_code']) {
          
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        $gender = $_SESSION['gender'];
        $phone = $_SESSION['phone'];
        $user_id = "USR" . mt_rand(10000, 99999);
        // Insert data into `form` table
        $stmt = $conn->prepare("INSERT INTO customers (User_Id, CustomerName, Email, Number, Password, Gender) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $user_id, $name, $email, $phone, $password, $gender);

        if ($stmt->execute()) {
            $message = "Registration successful! Your User ID has been sent to your email.";
            $mail = new PHPMailer(true);
            try {  
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; 
                $mail->SMTPAuth = true;
                $mail->Username = 'smjayanidesilva@gmail.com'; 
                $mail->Password = 'gbnk rjln ziif vuvm'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->setFrom('smjayanidesilva@gmail.com', 'Cinonaman Resort');
                $mail->addAddress($email, $name);
                $mail->isHTML(true);
                $mail->Subject = "Registration Successful - Your User ID";
                $mail->Body = "
                    <h2>Dear $name,</h2>
                    <p>Congratulations! Your registration is successful.</p>
                    <p><strong>Your User ID:</strong> <span style='color:blue;'>$user_id</span></p>
                    <br>
                    <p>Please keep this User ID safe as you will need it for future logins and service purchases.</p>
                    <p>Best regards,<br>Sunset Paradise</p>
                ";
                
                $mail->send();
            } catch (Exception $e) {
                $message = "Registration successful, but email sending failed: " . $mail->ErrorInfo;
            }
            session_destroy(); // Clear session after successful registration
        } else {
            $message = "Registration failed!";
        }

        $stmt->close();
        $conn->close();
    } else {
        $message = "Invalid verification code!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
</head>
<body>
    <form method="post" action="verify_email.php">
        <h2>Enter the verification code sent to your email</h2>
        <input type="text" name="verification_code" required>
        <input type="submit" value="Verify">
    </form>
    <?php
    if (!empty($message)) {
        echo "<p id='successMessage'>$message</p>";
        echo "<script>
            setTimeout(function() {
                window.location.href = 'home.php'; // Change this to your home page
            }, 5000);
        </script>";
    }
    ?>
</body>
</html>
