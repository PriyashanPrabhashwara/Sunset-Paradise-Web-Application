<?php include 'dbc.php'; 
session_start();

// Fetch room categories
$categories = [];
$categoryQuery = $conn->query("SELECT DISTINCT Category FROM foods");
while ($row = $categoryQuery->fetch_assoc()) {
    $categories[] = $row['Category'];
}

// Fetch all foods
$foods = [];
$foodQuery = $conn->query("SELECT * FROM foods");
while ($row = $foodQuery->fetch_assoc()) {
    $foods[] = $row;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering System</title>
    <link rel="stylesheet" href="shop.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="profile_modal.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script defer src="scripts.js"></script>
</head>
<body data-user-email="<?= isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>">

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

    <div class="cart-icon">
    <i class="fas fa-shopping-cart"></i> 
</div>
</header>

    <section class="image-container">
        <img src="https://d26np0chttzhum.cloudfront.net/wp-content/uploads/2021/10/12222137/desktop2.jpg" style="width:98.7vw;height:73vh;" class="img1">
        <img src="https://d1wvfb9o4f1cvo.cloudfront.net/2024/10/desktop-banner-1920-3.jpg" style="width:98.7vw;height:73vh;" class="img2">
    </section>

<div class="content-container">
    <h2 class="headline">BRINGING THE BEST FLAVOURS OF THE WORLD CLOSER TO YOU</h2>
    <h1 class="hotel-name">Sunset Paradise Unawatuna</h1>
    <p class="description">
        Celebrate food with multiple cuisines from your favourite five-star hotel. Our all-new
        delivery service lets you savour signature dishes from the best restaurants of Sunset Paradise Experience flavours from around the world, brought right to <strong>your doorstep and to your room </strong>
        adhering to the highest health and safety standards.
    </p>
</div>
    
    <div class="category-menu" style="display: flex;">
        <button class="category-btn active" data-category="all">All</button>
        <?php foreach ($categories as $category): ?>
            <button class="category-btn" data-category="<?= strtolower($category) ?>"><?= $category ?></button>
        <?php endforeach; ?>
    </div><br>
<main>

    <div class="food-container">
        <?php foreach ($foods as $food): ?>
            <div class="food-item" data-category="<?= strtolower($food['Category']) ?>">
                <img src="<?= $food['image'] ?>" alt="<?= $food['name'] ?>">
                <h3><?= $food['name'] ?></h3>
                <p>Price: Rs <?= $food['price'] ?></p><br>
                <input type="number" class="food-quantity" value="1" min="1" style="width: 50px; text-align: center; margin-right: 10px;">
                <button class="add-to-cart" 
                data-id="<?= $food['id'] ?>" 
                data-name="<?= $food['name'] ?>" 
                data-price="<?= $food['price'] ?>" 
                data-image="<?= $food['image'] ?>">
                Add to Cart
                </button>
            </div>
        <?php endforeach; ?>
    </div>
</main>



<!-- Cart Sidebar -->
<div class="cart-sidebar">
    <div class="cart-header">
        <span>Your Cart</span>
        <button id="close-cart">X</button>
    </div>
    <div class="cart-items">
        
    </div>

    
    <?php if (isset($_SESSION['user_id'])): ?>
        <button id="checkout-btn" class="category-btn" style="margin-top:60px;" onclick="window.location.href='checkout.php'">Checkout And Orders</button>
    <?php else: ?>
        <p style="color:red;">Log in to proceed to checkout.</p>
    <?php endif; ?>
</div>

<script>
    $(document).ready(function() {
        $(".category-btn").click(function() {
            $(".category-btn").removeClass("active");
            $(this).addClass("active");

            var category = $(this).attr("data-category");
            $(".food-item").hide().removeClass("show");

            if (category == "all") {
                $(".food-item").fadeIn().addClass("show");
            } else {
                $(".food-item[data-category='" + category + "']").fadeIn().addClass("show");
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

