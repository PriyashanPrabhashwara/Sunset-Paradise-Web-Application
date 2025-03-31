<?php

include 'dbc.php';

// Get the dining ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch dining details from the database
$sql = "SELECT * FROM dining WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$dining = $result->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($dining['name']); ?> - Details</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="dining_details.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="details-container">
        <div class="details-header">
            <img src="<?php echo htmlspecialchars($dining['image_url']); ?>" alt="<?php echo htmlspecialchars($dining['name']); ?>">
            <div class="details-title"><?php echo htmlspecialchars($dining['name']); ?></div>
        </div>
        <div class="details-content">
            <h2>About <?php echo htmlspecialchars($dining['name']); ?></h2>
            <p><?php echo htmlspecialchars($dining['description']); ?></p>

            <h2>Available Times</h2>
            <p><?php echo htmlspecialchars($dining['available_times']); ?></p>

            <h2>Key Amenities</h2>
            <div class="amenities-grid">
                <?php 
                // Split amenities into an array
                $amenities = explode(",", $dining['amenities']);
                foreach ($amenities as $amenity): 
                    $amenity = trim($amenity);
                ?>
                    <div class="amenity-card">
                        <!-- Optional: Add dynamic icon/image based on the amenity -->
                        <img src="icons/<?php echo strtolower(str_replace(' ', '_', $amenity)); ?>.png" alt="<?php echo $amenity; ?>" onerror="this.src='icons/default.png';">
                        <h4><?php echo htmlspecialchars($amenity); ?></h4>
                    </div>
                <?php endforeach; ?>
            </div>

            <a href="Dining.php" class="back-button">Back to Dining Options</a>
        </div>
 



<!-- Photo Gallery -->
<div class="gallery">
    <div class="gallery-item" data-category="buffet">
        <img src="https://i.pinimg.com/474x/4a/2f/5a/4a2f5a9a137271f71ee331d22271a1ea.jpg" alt="Buffet">
    </div>
    <div class="gallery-item" data-category="continental">
        <img src="https://i.pinimg.com/736x/83/3a/38/833a38414ed2d8867709231524b5f041.jpg" alt="Continental">
    </div>
    <div class="gallery-item" data-category="asian">
        <img src="https://i.pinimg.com/474x/d9/52/8e/d9528ec941bedc803951f17eb5314c87.jpg" alt="Asian Cuisine">
    </div>
    <div class="gallery-item" data-category="desserts">
        <img src="https://i.pinimg.com/474x/71/8a/88/718a88e9270cbb0fe0f9de2d6111edd0.jpg" alt="Desserts">
    </div>
    <div class="gallery-item" data-category="beverages">
        <img src="https://i.pinimg.com/736x/03/74/43/037443f42f9a661e2ab3c73be702b642.jpg" alt="Beverages">
    </div>

    <div class="gallery-item" data-category="desserts">
        <img src="https://i.pinimg.com/474x/ad/68/2a/ad682a4125a238d67a346f8e8478931d.jpg" alt="Beverages">
    </div>
</div>

<!-- Lightbox for Image Preview -->
<div class="lightbox">
    <span class="close">&times;</span>
    <img class="lightbox-content" id="lightbox-img">
</div>             

<br>

    <!-- form -->

   
        <h2 style="text-align:center;">Inquire Now</h2>

        <form action="dining_inquiry.php" method="POST" class="form-container">
            <div class="form-group">
                <label for="restaurant">Restaurant <span class="required">*</span></label>
                <select id="restaurant" name="restaurant" required>
                    <option value="" disabled selected>Select a Restaurant</option>
                    <?php
                    include 'dbc.php';
                    $query = "SELECT name FROM dining";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($row['name']) . '">' . htmlspecialchars($row['name']) . '</option>';
                        }
                    } else {
                        echo '<option value="" disabled>No restaurants available</option>';
                    }
                    $conn->close();
                    ?>
                </select>
            </div>

            <div class="form-group">
                    <label for="guests">Guests No: <span class="required">*</span></label>
                    <input type="text" id="guests" name="guests" required>
                </div>
            <div class="form-group-inline">
                <div class="form-group">
                    <label for="date">Date <span class="required">*</span></label>
                    <input type="date" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="time">Time <span class="required">*</span></label>
                    <input type="time" id="time" name="time" required>
                </div>
            </div>
            <div class="form-group-inline">
                <div class="form-group">
                    <label for="title">Title <span class="required">*</span></label>
                    <select id="title" name="title" required>
                        <option value="" disabled selected>Please Select</option>
                        <option value="Mr.">Mr.</option>
                        <option value="Ms.">Ms.</option>
                        <option value="Mrs.">Mrs.</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="first-name">First Name <span class="required">*</span></label>
                    <input type="text" id="first-name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name <span class="required">*</span></label>
                    <input type="text" id="last-name" name="last_name" required>
                </div>
            </div>
            <div class="form-group-inline">
                <div class="form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone <span class="required">*</span></label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message"></textarea>
            </div>
            <button type="submit" class="btn">Submit Inquiry</button>
        </form>
    </div>

    <div class="contact-us">
    <h2>Contact Us for further questions</h2>
    <p>+94 77 230 1328</p>
    </div>

    <script>
        $(document).ready(function () {
    // Lightbox Functionality
    $(".gallery-item img").click(function () {
        let imgSrc = $(this).attr("src");
        $("#lightbox-img").attr("src", imgSrc);
        $(".lightbox").fadeIn();
    });

    $(".lightbox .close").click(function () {
        $(".lightbox").fadeOut();
    });
});
    </script>

</body>
</html>



