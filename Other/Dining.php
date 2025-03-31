<?php

include 'dbc.php';

$sql = "SELECT * FROM dining";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dining Options</title>
    <link rel="stylesheet" href="dining.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

</head>
<body>

<header class="nav">
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
</header>

<section class="image-container">
        <img src="https://galadarihotel.imgix.net/2023/05/Flavours-Banner-8436-scaled.jpg?w=1920&h=965&fit=crop&crop=center&auto=format&auto=enhance&q=25&blend-crop=bottom,center&blend-align=bottom,center&blend-fit=crop&blend-h=965&blend-w=1920&blend-mode=multiply&blend=https://galadarihotel.imgix.net/2023/05/background-gradient-1920.png&fit=crop&h=965&w=1920" style="width:98.7vw;height:73vh;" class="img1">
        <img src="https://www.jetwinghotels.com/wp-content/uploads/2017/09/sri-lanka-dining-desktop-large.jpg" style="width:98.7vw;height:73vh;" class="img2">
    </section>

    <header class="dining-header">
        <h1>EXPERIENCE FINE DINING</h1>
        <p style="line-height: 40px;">Discover a world of exceptional culinary experiences that cater to every taste and occasion. Our hotel takes pride in offering a diverse range of dining options, each thoughtfully designed to tantalize your taste buds and create lasting memories. From elegant fine dining to casual, family-friendly atmospheres, each restaurant combines exquisite flavors, inviting ambiance, and unmatched service. Whether you’re savoring a perfectly grilled steak, enjoying vibrant international cuisines, or indulging in decadent desserts, every moment at our dining venues is crafted to delight. Let our chefs take you on an unforgettable journey of culinary artistry, where passion meets perfection in every bite. </p>
    </header>

    <section class="dining-options">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="dining-option">
                <a href="dining_details.php?id=<?php echo $row['id']; ?>"><img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>"></a>
                <h2><?php echo $row['name']; ?></h2>
                    
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No dining options available at the moment.</p>
        <?php endif; ?>
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

</body>
</html>

<?php
$conn->close();
?>