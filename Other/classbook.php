<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
   
    // Redirect to login page if not logged in
    
    header("Location: login.php");
    exit();
}
?>


<?php
    $message="";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $session=$_POST['sessionType'];
        $day=$_POST['day'];
        $package=$_POST['package'];
        $name=$_POST['name'];
        $email=$_POST['email'];

         // Create connection
         $conn = new mysqli("localhost", "root", "", "form_db");

         // Check connection
         if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
         }

        // Prepare an insert statement
        $stmt = $conn->prepare("INSERT INTO booking(Name,Email,Session,Day,Package) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name,$email,$session,$day,$package);

        // execute the statement

        if($stmt->execute()){
            $message="Booking Sucessful";
        }
        // Close the statement and connection
        $stmt->close();
        $conn->close();
        }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class & Personal Training Timetable</title>
    <link rel="stylesheet" href="Timetable.css?v=<?php echo time(); ?>">
</head>
<body style="background:linear-gradient(rgb(60,60,60),rgb(0,0,0),rgb(50,50,50));">

<header>

<img src="logo.png" width="60px" style="border-radius: 10px;"> 

    <nav>
        <ul>
        <li><a href="home.php">Home</a></li>
                <li><a href="Timetable.php">Services</a></li>
                <li><a href="Resrvations.php">Resrvations</a></li>
                <li><a href="Register.php">Register</a></li>
                <li><a href="membership.php">Membership</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="FAQ.php">FAQ</a></li>
                <li><a href="blog home.php">Blog</a></li>  
                <li><a href="shop.php">Order Online</a></li>
                <li><a href="Rating.php">Rate Us</a></li>              
        </ul>
    </nav>

<a class="btn1" href="login.php">Sign-in</a>
<a class="btn1" href="logout.php">Sign-out</a>
</header>

<!-- Booking Form -->
<div class="booking-form">
            <h3 style="color:white">Book a Session</h3>
            <form id="bookingForm" action="classbook.php" method="post">

                <label for="name">Your Name:</label>
                <input type="text" name="name" id="name">

                <label for="email">Your Email:</label>
                <input type="email" name="email" id="email">

                <label for="sessionType">Choose a Session:</label>
                <select id="sessionType" name="sessionType" required>
                    <option value="Yoga">Yoga</option>
                    <option value="Zumba">Zumba</option>
                    <option value="HIIT">HIIT</option>
                    <option value="Personal Training">Personal Training</option>
                </select>

                <label for="day">Choose a Day:</label>
                <select id="day" name="day" required>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                </select>


                <label for="package">Choose a Package:</label>
                <select id="package" name="package" required>
                    <option value="class1">Drop-in Class: $5 per session</option>
                    <option value="class2">Single Class: $10 per session</option>
                    <option value="class3">5-Class Package: $10 (Save 13%)</option>
                    <option value="class4">10-Class Package: $20 (Save 20%)</option>
                    <option value="class5">Monthly Unlimited Package: $22</option>
                    <option value="class6">Small Group Training: $35 per person per session</option>
                </select>

                <button type="submit">Book Now</button>
            </form>
            <h2 style="color: orangered;margin-top:40px;margin-right:auto;margin-left:auto;"><?php echo $message?></h2>
        </div>
    </div>
</body>
</html>