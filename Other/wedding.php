<?php

include('dbc.php');

// Handle AJAX request to fetch available dates based on package name
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['packageName'])) {
    $packageName = $_POST['packageName'];

    $stmt = $conn->prepare("SELECT available_dates FROM weddingpackages WHERE package_name = ?");
    $stmt->bind_param("s", $packageName);
    $stmt->execute();
    $stmt->bind_result($availableDates);
    $stmt->fetch();
    $stmt->close();

    // Return available dates as JSON
    echo json_encode(explode(',', $availableDates));
    exit;
}

// Fetch all package names for dropdown
$packages = [];
$result = $conn->query("SELECT package_name FROM weddingpackages");
while ($row = $result->fetch_assoc()) {
    $packages[] = $row['package_name'];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dream Wedding Venue</title>
  <link rel="stylesheet" href="wedding.css?v=<?php echo time(); ?>">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

  <script>
        document.addEventListener("DOMContentLoaded", function () {
            const packageNameDropdown = document.getElementById("packageName");
            const availableDateDropdown = document.getElementById("availableDate");

            // Fetch available dates when a package is selected
            packageNameDropdown.addEventListener("change", function () {
                const packageName = this.value;

                // Clear previous dates
                availableDateDropdown.innerHTML = '<option value="">Please Select the Date</option>';

                if (packageName) {
                    // Send AJAX request to fetch available dates
                    fetch("wedding.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `packageName=${encodeURIComponent(packageName)}`
                    })
                    .then(response => response.json())
                    .then(dates => {
                        dates.forEach(date => {
                            const option = document.createElement("option");
                            option.value = date;
                            option.textContent = date;
                            availableDateDropdown.appendChild(option);
                        });
                    })
                    .catch(error => console.error("Error fetching dates:", error));
                }
            });
        });
    </script>

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

  <!-- Introduction Section -->
  <section class="wedding-intro">
    <div class="intro-content">
      <h1 style="color:darkgrey">Make Your Special Day Unforgettable</h1>
      <p>From romantic settings to exquisite dining, let us help you create lasting memories.</p>
      <a href="#inquiry-form" class="btn">Plan Your Wedding</a>
    </div>
  </section>

  

  <!-- Wedding Packages -->


  <div class="wedding-section">
        <h1 class="section-title">Explore Our Wedding Packages</h1>
        <a href="fetch_packages.php" class="btn">Explore</a>
    </div>


  <!-- Gallery -->
  <section class="wedding-gallery">
    <h2>Wedding Memories</h2>
    <div class="gallery-container">
      <img src="https://images.pexels.com/photos/169189/pexels-photo-169189.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Wedding Venue">
      <img src="https://images.pexels.com/photos/1045541/pexels-photo-1045541.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Decorations">
      <img src="https://images.pexels.com/photos/1295946/pexels-photo-1295946.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Couple">
    </div>
  </section>

  <!-- Services Offered -->

  <section class="wedding-services">
  <h2 style="font-size: 2.5rem;color: #d87c61;text-align:center;margin:17px;">Our Wedding Services</h2>
  <div class="services-container">
    <div class="service-card">
      <div class="card-front">
        <img src="https://images.pexels.com/photos/16120232/pexels-photo-16120232/free-photo-of-tables-in-wedding-reception-venue.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Venue Rental">
        <h3>Venue Rental</h3>
      </div>
      <div class="card-back">
        <h3>Venue Rental</h3>
        <p>Our venues offer luxurious spaces for both ceremonies and receptions. From intimate garden settings to grand ballrooms, we ensure your dream wedding venue is perfect for the occasion.</p>
      </div>
    </div>

    <div class="service-card">
      <div class="card-front">
        <img src="https://images.pexels.com/photos/1128783/pexels-photo-1128783.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Catering">
        <h3>Catering</h3>
      </div>
      <div class="card-back">
        <h3>Catering</h3>
        <p>Delight your guests with our exceptional culinary creations. Choose from customizable menus, including vegan, vegetarian, and international cuisines, designed to satisfy every palate.</p>
      </div>
    </div>

    <div class="service-card">
      <div class="card-front">
        <img src="https://images.pexels.com/photos/1616113/pexels-photo-1616113.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Decorations">
        <h3>Decorations</h3>
      </div>
      <div class="card-back">
        <h3>Decorations</h3>
        <p>Transform your wedding into a magical experience with our tailored wedding themes, floral arrangements, and stunning decorations that match your personal style and vision.</p>
      </div>
    </div>

    <div class="service-card">
      <div class="card-front">
        <img src="https://images.pexels.com/photos/1024993/pexels-photo-1024993.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Photography">
        <h3>Photography</h3>
      </div>
      <div class="card-back">
        <h3>Photography</h3>
        <p>Our professional photographers capture every beautiful moment of your wedding, ensuring you have a timeless collection of memories to cherish forever.</p>
      </div>
    </div>
  </div>
</section>


  <!-- Testimonials -->
  <section class="wedding-testimonials">
  <h2 style="font-size: 2.5rem;color: #d87c61;">What Our Couples Say</h2>
  <div class="testimonial-container">
    <div class="testimonial">
      <p>"The venue was breathtaking, and the team went above and beyond to make our day perfect. It truly felt like a fairytale."</p>
      <h4>- Emma & Jack</h4>
      <img src="emma-jack.jpg" alt="Emma & Jack">
    </div>
    <div class="testimonial">
      <p>"From the catering to the decorations, everything was flawless. Our guests couldn't stop raving about how beautiful it all was."</p>
      <h4>- Sarah & James</h4>
      <img src="sarah-james.jpg" alt="Sarah & James">
    </div>
    <div class="testimonial">
      <p>"We couldn’t have asked for a better experience. The team made sure every detail was perfect. Thank you for making our day unforgettable!"</p>
      <h4>- Mia & Liam</h4>
      <img src="mia-liam.jpg" alt="Mia & Liam">
    </div>
    <div class="testimonial">
      <p>"Absolutely stunning venue and exceptional service. Everything was perfectly organized, and we felt so cared for."</p>
      <h4>- Olivia & Noah</h4>
      <img src="olivia-noah.jpg" alt="Olivia & Noah">
    </div>
  </div>
</section>





  <!-- Wedding Inquiry Form -->
  <div class="inquiry-form">
    <h1>INQUIRE NOW</h1>
    <form id="inquiry-form">
        <label for="packageName">Wedding Package Name *</label>
        <select id="packageName" name="packageName" required>
            <option value="">Please Select</option>
            <?php foreach ($packages as $packageName): ?>
                <option value="<?= htmlspecialchars($packageName) ?>"><?= htmlspecialchars($packageName) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="availableDate">Available Date *</label>
        <select id="availableDate" name="availableDate" required>
            <option value="">Please Select the Date</option>
            <!-- Options will be populated dynamically -->
        </select>

        <label for="title">Title *</label>
        <select id="title" name="title" required>
            <option value="">Please Select</option>
            <option value="Mr.">Mr.</option>
            <option value="Ms.">Ms.</option>
            <option value="Mrs.">Mrs.</option>
        </select>

        <label for="fullName">Full Name *</label>
        <input type="text" id="fullName" name="fullName" required />

        <label for="email">Email *</label>
        <input type="email" id="email" name="email" required />

        <label for="phone">Phone *</label>
        <input type="tel" id="phone" name="phone" required />

        <label for="message">Message</label>
        <textarea id="message" name="message"></textarea>

        <button type="submit" class="btn">Submit</button>
    </form>
</div>

  <!-- Wedding Countdown -->
  <section class="wedding-countdown">
    <h2>Countdown to Your Big Day</h2>
    <div id="countdown"></div>
  </section>

  <script src="wedding.js"></script>
</body>

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
</html>
