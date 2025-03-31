<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        session_start();
        // Check if user is logged in
        if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $_POST['uid']) {
            header("Location: login.php"); // Redirect to login if not logged in or mismatched ID
            exit();
        }

        $name=$_POST['name'];
        $uid=$_POST['uid'];
        $message=$_POST['message'];
        
            include 'dbc.php';

            // Prepare an insert statement
            $stmt = $conn->prepare("INSERT INTO Queries(Name,User_ID,Message) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name,$uid,$message);

            // execute the statement
            if($stmt->execute()){
                $response="Message sent Sucessful";
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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sunset Paradise|Sri-Lanaka Resort</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="profile_modal.css?v=<?php echo time(); ?>">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
</head>
<body>

    <!-- Navbar -->
    <header>
    <nav>
        <ul>
            <li><a href="home.php" class="animated-link">Home</a></li>
            <li><a href="Experience.php" class="animated-link">Experiences</a></li>
            <li><a href="Reservation.php" class="animated-link">Reservations</a></li>
            <li><a href="Register.php" class="animated-link">Register</a></li>
            <li><a href="wedding.php" class="animated-link">Wedding</a></li>
            <li><a href="about.php" class="animated-link">About Us</a></li>
            <li><a href="FAQ.php" class="animated-link">FAQ</a></li>
            <li><a href="Dining.php" class="animated-link">Dining</a></li>
            <li><a href="shop.php" class="animated-link">Order Online</a></li>
            <li><a href="Rating.php" class="animated-link">Rate Us</a></li>
        </ul>
    </nav>
    <?php session_start(); ?>
    <div class="btn-container">
    <?php if (!isset($_SESSION['user_id'])): ?>
        <a class="btn1 animated-link" href="login.php">Sign-in</a>
    <?php else: ?>
        <?php 
            $fullName = $_SESSION['full_name'] ?? ''; 
            $nameParts = explode(" ", $fullName); 
            $initials = strtoupper(substr($nameParts[0], 0, 1) . (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : '')); ?>
        <button id="profileBtn" class="profile-initials"><?php echo $initials; ?></button>
    <?php endif; ?>
    <a class="btn1" href="logout.php" style="<?php echo isset($_SESSION['user_id']) ? '' : 'display:none;'; ?>">Sign-out</a>
    </div>
</header>
<div class="background">
<div class="content" style="position:absolute;left:487px;top:130px;filter: brightness(150%);">
        <h1 style="color: white;">Welcome to The Sunset Paradise</h1>
        <h1 style="color: white;font-size:25px;font-style:italic;">The Best Accommodation</h1><br><br>
        <h1><a href="Register.php" class="btn">Register Now</a></h1>
    </div>
</div>
    

    <section class="details" style="color: gold;
            font-weight: bold;background:url('https://static.vecteezy.com/system/resources/previews/007/184/857/non_2x/background-and-texture-on-low-light-free-photo.jpg');">
        <ul>
            <li><i class="fas fa-spa"></i>State-of-the-art spa and wellness center for ultimate relaxation.</li><br>
            <li><i class="fas fa-utensils"></i>Exclusive fine dining with gourmet dishes crafted by top chefs.</li><br>
            <li><i class="fas fa-bed"></i>Luxury suites with breathtaking ocean or garden views.</li><br>
            <li><i class="fas fa-swimmer"></i>Infinity pools and private beach access for a serene escape.</li><br>
            <li><i class="fas fa-concierge-bell"></i>Personalized concierge services to cater to your every need.</li><br>
            <li><i class="fas fa-ship"></i>Exciting local excursions, sunset cruises, and cultural experiences.</li>
        </ul>

        <img src="https://imageio.forbes.com/specials-images/imageserve/5f1d6cf0beb6d41e252bf858/A-colorful-garden-at-Rancho-Valencia-Hotel-/960x0.jpg?format=jpg&width=960" style="width: 400px;height:270px">
    </section>

    <div class="benifits-title">
    <a class="btn1" href="about.php" style="font-size:18px;margin-top:25px;margin-left:120px;">Learn More</a><br><br>
    <h1 style="padding-top: 20px;margin-left:450px">Benifits</h1>
    </div>

    <hr style="background-color:brown; height:5px;">


    <div class="benifit-container">
        <div class="benifits">
            <img src="https://hospitalityinsights.ehl.edu/hubfs/Blog-EHL-Insights/Blog-Header-EHL-Insights/wealth%20wellness.jpeg">
            <div class="layer">
                <h1>Luxury Spa Treatments</h1>
                <p>Relax and rejuvenate with world-class spa treatments designed to revitalize your body and mind.</p>
            </div>
        </div>

        <div class="benifits">
            <img src="https://i.pinimg.com/474x/4a/2f/5a/4a2f5a9a137271f71ee331d22271a1ea.jpg">
            <div class="layer">
                <h1>Fine Dining Experience</h1>
                <p>Indulge in gourmet dishes crafted by our expert chefs, offering a unique blend of flavors.</p>
            </div>
        </div>

        <div class="benifits">
            <img src="beach.jpeg">
            <div class="layer">
                <h1>Private Beach & Pools</h1>
                <p>Enjoy exclusive access to serene beaches and infinity pools for a truly peaceful retreat.</p>
            </div>
        </div>
    </div>

        <section class="contact">
            <h1 style="text-align: left;">Get In Touch</h1>
            <div class="layout">

            <div class="form">
            <form action="home.php" method="post" onsubmit="alert('Your Query Has been Submitted')">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" required>

                <label for="uid">Your ID</label>
                <input type="text" id="uid" name="uid" required>

                <label for="message">Your Message</label>
                <textarea id="message" name="message" rows="5" required></textarea><br>

                <button type="submit">Send Message</button>
                <a href="my-queries.php" class="btn1">View Response</a>
            </form>
            
            </div>

            <div class="contact-info">
                
             <div class="info-box">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Our Location</h3>
                <p>Sunset Paradise Hotel<br>123 Matara Road,Unawatuna</p>
             </div><br>
             <div class="info-box">
                <i class="fas fa-phone-alt"></i>
                <h3>Call Us</h3>
                <p><a href="tel:+1234567890"> +94 114308034</a></p>
             </div><br>
             <div class="info-box">
                <i class="fas fa-envelope"></i>
                <h3>Email Us</h3>
                <p><a href="mailto:info@FitZonegym.com">info@SunsetParadise.com</a></p>
             </div>

            </div>

            <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63291.64752519683!2d80.30855017821581!3d7.495256775896501!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae33a1c41f7701b%3A0x2782fba8f1cec110!2sFITLINERS%20VIP%20GYM%20KURUNEGALA%20and%20FITLINE%20PRO%20FITNESS%20ACADEMY!5e0!3m2!1sen!2slk!4v1729327048350!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
             </div>

            </div>
        </section>
    

    <!-- Footer -->
    <footer style="opacity:0.8;">
        <p>&copy; Copyright © 2025 Sunset Paradise | All Rights Reserved.</p>
        
        <div class="socials">
            <a href="">
              <i class="fa-brands fa-facebook"></i>
            </a>
            <a href="">
              <i class="fa-brands fa-twitter"></i>
            </a>
            <a href="">
              <i class="fa-brands fa-linkedin"></i>
            </a>
        </div>
    </footer>

    <script>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="profile_modal.js"></script>

</body>
</html>

<?php





?>