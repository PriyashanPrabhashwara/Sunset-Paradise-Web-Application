<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include 'dbc.php'; // Database connection

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $selected_option = $_POST['gender'];
    $number = $_POST['phone'];
    $password = $_POST['password'];

    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM customers WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $message = "Email already registered!";
    } else {
        // Generate a 6-digit verification code
        $verification_code = mt_rand(100000, 999999);
        $_SESSION['verification_code'] = $verification_code;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['gender']=$selected_option;
        $_SESSION['phone']=$number;
        $_SESSION['password'] = $password;
        // Send email using PHPMailer
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
            $mail->addAddress($email);
            $mail->Subject = 'Email Verification Code';
            $mail->Body = "Hello $name,\n\nYour verification code is: $verification_code\n\nEnter this code to complete your registration.";
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
}
?>

<html>
<head>

    <title>Registration</title>
    <link rel="stylesheet" href="register.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="container">
        <div class="left-content">
            
            <i class="fas fa-hotel" style="font-size: 40px;position:absolute;top:-100px;left:320px;"></i>
            <h1>REGISTER TO OUR HOTEL</h1>
            <p>Welcome to Sunset Paradise Hotel, your luxurious getaway destination. Experience world-class hospitality, breathtaking views, and top-notch amenities. Whether you're here for leisure or business, we ensure a comfortable and memorable stay.</p>
            <div class="buttons">
                <a class="btn-know" href="about.php">Know More</a>
                
            </div>
        </div>
        <div class="form-box">
            <form action="Register.php" method="post" onsubmit="return confirmPasswordMatch();">
                <h1><i class="fas fa-user-edit"  style="margin-left: -10px;"></i> REGISTER HERE</h1>
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}" title="Password must be at least 8 characters long and contain at least one letter and one number">

                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required> 
                <span style="color:yellow;" id="msg"></span>

                <label>Gender:</label>
                <div class="radio-group">
                    <label><input type="radio" name="gender" value="male" required> Male</label>
                    <label><input type="radio" name="gender" value="female"> Female</label>
                    <label><input type="radio" name="gender" value="other"> Other</label>
                </div>

                <div class="checkbox-container">
                    <input type="checkbox" name="Agree" required>
                    <label>I agree to the <a href="#">terms and conditions</a></label>
                </div>
                
                <input type="submit" value="Register">

                <div class="already-account">
                    <p>Already have an Account? <a href="login.php">Sign in</a></p>
                </div>

                <h2 style="text-align: center; color:brown; font-weight: bold;"> <?php echo $message;?> </h2>
            </form>
        </div>
    </div>

<script>
    function confirmPasswordMatch() {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    const msg = document.getElementById("msg");

    if (password !== confirmPassword) {
        msg.innerText = "Passwords do not match!";
        msg.style.color = "red"; // Set error message color
        return false; // Prevent form submission
    } else {
        msg.innerText = ""; // Clear the message if passwords match
        return true; // Allow form submission
    }
}

    document.querySelectorAll(".animated-link").forEach(link => {
    link.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent instant navigation
        
        gsap.to("body", {
            rotationY: 180,  // 3D rotation effect
            opacity: 0,
            duration: 1,
            onComplete: () => {
                window.location.href = this.href; // Navigate after animation
            }
        });
    });
});

</script>
    
</body>
</html>



