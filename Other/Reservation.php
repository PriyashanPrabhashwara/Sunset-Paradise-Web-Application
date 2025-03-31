<?php
include 'dbc.php';

// Fetch room categories
$categories = [];
$categoryQuery = $conn->query("SELECT DISTINCT category FROM rooms");
while ($row = $categoryQuery->fetch_assoc()) {
    $categories[] = $row['category'];
}

// Fetch all rooms
$rooms = [];
$roomQuery = $conn->query("SELECT * FROM rooms");
while ($row = $roomQuery->fetch_assoc()) {
    $rooms[] = $row;
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
    <link rel="stylesheet" href="rooms.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
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
    <section class="image-container">
        <img src="build1.jpg" style="width:98.7vw;height:73vh;" class="img1">
        <img src="build2.webp" style="width:98.7vw;height:73vh;" class="img2">
    </section>
    <h2 style="margin-top: 15px;">Accommodation</h2>
    <a style="position:absolute;left:1330px;top:595px;" class="btn2" href="booking.php">Book Now</a>
    <div style="width:65vw;margin-left:auto;margin-right:auto;margin-top: 15px;">
        <p style="text-align:justify;">
        As one of the premier hotels in Colombo, Galadari Hotel Colombo offers a diverse selection of accommodations tailored for both business travelers and leisure seekers. 
        Whether you desire the refined comfort of a Superior Room or the unmatched luxury of a Presidential Suite, 
        our hotel provides an exquisite blend of elegance and relaxation in the heart of the city.<br><br>
        Start your day with breathtaking views of the Indian Ocean, accompanied by a freshly brewed cup of coffee or tea, 
        and unwind in sophistication after a long day of meetings or sightseeing. With thoughtfully designed rooms and suites, 
        we ensure that luxury, comfort, and convenience are always within reach, making your stay truly unforgettable.
        </p>
    </div>
    <div class="container">
    <h2>Our Hotel Rooms</h2>
    <!-- Category Filter -->
    <div class="category-menu">
        <button class="category-btn active" data-category="all">All</button>
        <?php foreach ($categories as $category): ?>
            <button class="category-btn" data-category="<?= strtolower($category) ?>"><?= $category ?></button>
        <?php endforeach; ?>
    </div>
    <!-- Room Listings -->
    <div class="room-container">
        <?php foreach ($rooms as $room): ?>
            <div class="room-card" data-category="<?= strtolower($room['category']) ?>">
                <img src="<?= $room['image_url'] ?>" alt="<?= $room['name'] ?>">
                <h3><?= $room['name'] ?></h3>
                <p>Occupancy: <?= $room['occupancy'] ?> Adults</p>
                <p>Size: <?= $room['size'] ?></p>
                <p>Amenities: <?= $room['amenities'] ?></p>
                <p>Price: Rs <?= $room['price'] ?>- Per Night</p>
                <div class="buttons">
                    <a href="room_details.php?id=<?= $room['id'] ?>" class="btn book-btn">Find Out More</a>
                    
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".category-btn").click(function() {
            $(".category-btn").removeClass("active");
            $(this).addClass("active");

            var category = $(this).attr("data-category");
            $(".room-card").hide().removeClass("show");

            if (category == "all") {
                $(".room-card").fadeIn().addClass("show");
            } else {
                $(".room-card[data-category='" + category + "']").fadeIn().addClass("show");
            }
        });
    });

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