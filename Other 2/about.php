<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - FitZone Fitness Center</title>
    <link rel="stylesheet" href="about.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="profile_modal.css?v=<?php echo time(); ?>">
</head>
<body>

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
            // Extract initials
            $fullName = $_SESSION['full_name'] ?? ''; 
            $nameParts = explode(" ", $fullName); 
            $initials = strtoupper(substr($nameParts[0], 0, 1) . (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : '')); 
        ?>
        <button id="profileBtn" class="profile-initials"><?php echo $initials; ?></button>
    <?php endif; ?>
    
    <a class="btn1" href="logout.php" style="<?php echo isset($_SESSION['user_id']) ? '' : 'display:none;'; ?>">Sign-out</a>

    </div>


</header>

       <!-- Hero Section -->
       <section class="hero">
    <div class="hero-content">
        <h1>Welcome to Sunset Paradise Hotel</h1>
        <p>Experience the Perfect Blend of Luxury, Serenity, and Unmatched Hospitality!</p>
    </div>
</section>


    <!-- Mission Section -->
    <section class="mission">
    <h2>Our Mission</h2>
    <p>At Sunset Paradise Hotel, we are dedicated to providing an exceptional hospitality experience where luxury meets comfort. Nestled in a breathtaking location, we ensure that every guest enjoys personalized service, world-class amenities, and a stay filled with unforgettable moments. Whether you're here for a romantic getaway, a family vacation, or a business retreat, our goal is to make your stay truly extraordinary.</p>
</section>

    <!-- Core Values Section -->
    <section class="core-values">
    <h2>Our Core Values</h2>
    <div class="values-container">
        <div class="value">               
            <h3>Excellence</h3>
            <p>We are committed to delivering the highest standards in hospitality, ensuring that every guest experiences impeccable service, luxurious accommodations, and exquisite dining.</p>
        </div>
        <div class="value">            
            <h3>Customer-Centric Approach</h3>
            <p>Your satisfaction is our priority. Our team goes above and beyond to anticipate and fulfill your needs, making sure every moment of your stay is seamless and memorable.</p>
        </div>
        <div class="value">
            <h3>Authenticity</h3>
            <p>From our locally inspired cuisine to our warm, welcoming atmosphere, we celebrate authenticity. Our hotel embraces the culture and beauty of the region, offering guests a true taste of paradise.</p>
        </div>
    </div>
</section>


    <br>

    <!-- Our Story Section -->
    <section class="our-story">
    <div class="story-content">
        <div class="story-text">
            <h2>Our Story</h2>
            <p>Founded in 2024 in Unawatuna, Sunset Paradise Hotel was born out of a passion for creating an oasis where guests can escape the ordinary and immerse themselves in a world of relaxation and luxury. From a boutique retreat to a renowned haven for travelers, we have grown into a destination that blends modern elegance with natural beauty. Our vision has always been to provide an unforgettable experience that lingers in the hearts of our guests long after they leave.</p>
        </div>
        <div class="story-image">
            <img src="backg.jpg" alt="Sunset Paradise Hotel">
        </div>
    </div>
</section>

    <!-- Meet the Team Section -->
    <section class="meet-team">
    <h2>Meet Our Team</h2>
    <div class="team-container">
        <div class="team-member">
            <img src="manager.jpeg" alt="Manager">
            <h3>Niupn Lakshitha</h3>
            <p>General Manager with over 15 years in luxury hospitality. Ensures every guest enjoys a seamless, five-star experience.</p>
        </div>
        <div class="team-member">
            <img src="chef.jpeg" alt="Chef">
            <h3>Nipunika Siriwardana</h3>
            <p>Executive Chef, specializing in international and fusion cuisine. Her passion for culinary excellence brings unique flavors to our dining experience.</p>
        </div>
        <div class="team-member">
            <img src="fd manager.jpeg" alt="Front Desk">
            <h3>Imalka Yaditha</h3>
            <p>Front Desk Manager, dedicated to making your stay unforgettable from the moment you arrive.</p>
        </div>
        <div class="team-member">
            <img src="spa.jpeg" alt="Spa Therapist">
            <h3>Vishmi Prabashari</h3>
            <p>Wellness & Spa Specialist, offering rejuvenating treatments designed to relax your mind and body.</p>
        </div>
    </div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="profile_modal.js"></script>

</body>
</html>
