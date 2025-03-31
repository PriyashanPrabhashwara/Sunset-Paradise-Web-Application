<?php
include('dbc.php');

    // Fetch activities
        $activities = [];
        $result = $conn->query("SELECT id, name, image_url FROM activities");
        while ($row = $result->fetch_assoc()) {
            $activities[] = $row;
    }
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Experience</title>
    <link rel="stylesheet" href="activity.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="profile_modal.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <style>
        /* Experience Section Styling */
        .experience-section {
            position: relative;
            height: 100vh;
            background: url('https://transferbudapesthungary.com/images/Get_Bus_Tour_Trip_Travel_Getting_to_from_around_plane_car_driver_ride_local_guide_coach_rental_day_trip_transfer_transportation_taxi_private_airport_hotel_sight_seeing_tours_shuttle_visit_way_minibus_chauffeur.jpg') no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        /* Background Overlay */
        .experience-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6); /* Dark overlay */
            backdrop-filter: blur(2px); /* Blur effect */
        }

        /* Content Box */
        .experience-content {
            position: relative;
            max-width: 700px;
            padding: 30px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            backdrop-filter: blur(8px);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Book Now Button */
        .book-btn {
            display: inline-block;
            padding: 12px 30px;
            background: orange;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(255, 165, 0, 0.5);
        }

        .book-btn:hover {
            background: darkorange;
            transform: scale(1.05);
        }
    </style>

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

    <section id="experience" class="fade-in">
    <div class="container">
        <h1 class="section-title">Experience Our Luxury Hotel</h1>

        <!-- Guest Testimonials -->
        <section class="testimonials">
        <h2>TESTIMONIALS</h2>
        <p style="text-align: center;color:red;">Our guests love their stay! See what they have to say about our hotel.</p><br>

        <div class="testimonial-container">
            <div class="testimonial">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlSLzDGU3KkIi9Qe67hQEMD4ALdGUBMDQIjDLvFNwYU4MFOXQjk9R62RI&s" alt="Guest 1">
                <p>“From the moment we arrived, we felt at home. The rooms were spotless, and the service was top-notch.”</p>
                <h4>James M.</h4>
                <span>Business Traveler</span>
            </div>

            <div class="testimonial">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQeletHy6F9N6ZBm8yHQsArNWOvYCruTciS950tRPsZ2MkZh-Im1g2s3y16AvyD6qXJyGA&usqp=CAU" alt="Guest 2">
                <p>“The perfect blend of luxury and comfort! The hotel’s ambiance, food, and friendly staff made our vacation unforgettable.”</p>
                <h4>Sarah L.</h4>
                <span>Family Vacationer</span>
            </div>

            <div class="testimonial">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRp-mDbSvY-6OBptD0oDg8Anz4InFTSnySQcMcAUMHin5bk_e8C9FCLYtA&s" alt="Guest 3">
                <p>“A five-star experience! The staff went above and beyond to ensure our stay was perfect.”</p>
                <h4>Michael R.</h4>
                <span>Honeymoon Couple</span>
            </div>

            <div class="testimonial">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT72N7V9SJ7aZUKneRSCb8VzMvhGZ-THCsqpCvzLiTS7YNt6zwSMeH1BsRojORgsZM5PC4&usqp=CAU" alt="Guest 4">
            <p>“An absolute gem! The hospitality was beyond expectations, and the ocean view from our suite was breathtaking.”</p>
            <h4>Emily W.</h4>
            <span>Solo Traveler</span>
        </div>
        
        </div>
    </section>

        <!-- Gallery -->
        <div class="gallery section">
            <h2>Discover Our Hotel</h2><br>
            <div class="gallery-grid">
                <img src="http://localhost/assignment/bg3.jpg" alt="Hotel Interior">
                <img src="https://www.jetwinghotels.com/wp-content/uploads/2017/09/sri-lanka-dining-desktop-large.jpg" alt="Scenic View">
                <img src="http://localhost/assignment/build2.webp" alt="Hotel Interior">
                
            </div>
        </div>

        <!-- Local Attractions -->
        <div class="local-attractions section">
            <h2>Must-See Attractions</h2>
            <ul>
                <li><strong>Sunset Beach</strong> - Enjoy a breathtaking ocean view.</li>
                <li><strong>Historic Museum</strong> - Dive into the past with rich historical exhibits.</li>
                <li><strong>Scenic Park</strong> - Perfect for a relaxing stroll in nature.</li>
            </ul>
        </div>

        <!-- Activities -->
        <section id="activities">
            <h2>Exciting Activities</h2>
            <div class="activity-cards">
                <?php foreach ($activities as $activity): ?>
                    <div class="card">
                        <a href="activity_detail.php?id=<?= htmlspecialchars($activity['id']) ?>">
                            <img src="<?= htmlspecialchars($activity['image_url']) ?>" alt="<?= htmlspecialchars($activity['name']) ?>">
                            <h3><?= htmlspecialchars($activity['name']) ?></h3>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Virtual Tour -->
        <div class="virtual-tour section">
            <h2>Take a Virtual Tour</h2>
            <iframe src="https://www.youtube.com/embed/example" frameborder="0" allowfullscreen></iframe>
        </div>

        <!-- Special Packages -->
        <div class="special-packages section">
            <h2>Exclusive Offers</h2>
            <ul>
                <li><strong>Romantic Getaway</strong> - Indulge in a luxurious experience for two.</li>
                <li><strong>Family Adventure</strong> - Enjoy fun activities and family-friendly amenities.</li>
                <li><strong>Weekend Escape</strong> - Relax with a short yet unforgettable trip.</li>
            </ul>
        </div>

        <section class="experience-section">
        <div class="experience-content">
            <h1>Experience Unmatched Comfort & Convenience</h1>
            <p>Discover the ease of travel with our premium transport services. Whether you're exploring breathtaking landscapes or heading to your next destination, we ensure a smooth and comfortable journey.</p><br>
            <a href="taxi_booking.php" class="book-btn">Book Now</a>
        </div>
    </section>

    </div>
</section>

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