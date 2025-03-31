<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "form_db");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$msg = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['customer_name'];
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];
    $image_url = '';

    // Handle file upload
    if (!empty($_FILES['review_image']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["review_image"]["name"]);
        if (move_uploaded_file($_FILES["review_image"]["tmp_name"], $target_file)) {
            $image_url = $target_file;
        } else {
            $msg = "Sorry, there was an error uploading your image.";
        }
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO reviews (customer_name, rating, review_text, image_url) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $customer_name, $rating, $review_text, $image_url);
    if ($stmt->execute()) {
        $msg = "Thank you for your review!";
    } else {
        $msg = "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reviews</title>
    <link rel="stylesheet" href="rating.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="profile_modal.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
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

    <div class="container">
        <h2>Customer Reviews</h2>
        <p><?php echo $msg; ?></p>
        <form id="reviewForm" method="POST" enctype="multipart/form-data">

            <label for="customer_name">Name:</label>
            <input type="text" id="customer_name" name="customer_name" required>

            <label for="rating">Rating (1-5):</label>
            <select id="rating" name="rating" required>
                <option value="1">1 - Poor</option>
                <option value="2">2 - Fair</option>
                <option value="3">3 - Good</option>
                <option value="4">4 - Very Good</option>
                <option value="5">5 - Excellent</option>
            </select>

            <label for="review_text">Review:</label>
            <textarea id="review_text" name="review_text" rows="4"></textarea required>

            <label for="review_image">Upload an image:</label>
            <input type="file" id="review_image" name="review_image" required>

            <button style="text-align:center;" class="btn" type="submit">Submit Review</button>
        </form>
        <br>
        <h3>All Reviews</h3>
        <?php
        // Fetch and display reviews
        $result = $conn->query("SELECT * FROM reviews ORDER BY created_at DESC");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="review-card">';
                echo '<h4>' . htmlspecialchars($row['customer_name']) . '</h4>';

                echo '<div class="star-rating">';
                $rating = $row['rating'];  // Get the rating from the database
                for ($i = 1; $i <= 5 ; $i++) {

                    echo '<span class="star' . ($i <= $rating ? ' filled' : '') . '">★</span>';
                }
                echo '</div>';

                echo '<p>' . htmlspecialchars($row['review_text']) . '</p>';
                if (!empty($row['image_url'])) {
                    echo '<img src="' . htmlspecialchars($row['image_url']) . '" alt="Customer Image">';
                }
                echo '<br>';
                echo '<small>Published on: ' . $row['created_at'] . '</small>';
                echo '</div>';
            }
        } else {
            echo "<p>No reviews yet.</p>";
        }
        $conn->close();
        ?>
    </div>

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

<script>
    document.getElementById("reviewForm").addEventListener("submit", function(event) {
        <?php if (!isset($_SESSION['user_id'])): ?>
            event.preventDefault(); // Stop form submission

            // Show alert using SweetAlert2
            Swal.fire({
                icon: 'warning',
                title: 'Login Required',
                text: 'You need to log in to submit a review!',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="profile_modal.js"></script>
</body>
</html>
