<html>
    <head>
        <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="faq.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="profile_modal.css?v=<?php echo time(); ?>">
    </head>
    <body style="background:url('gym\ bg0.jpg');">

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

    <div class="faq-section">
    <h2>Frequently Asked Questions (FAQ)</h2>

    <div class="faq-item">
    <button class="faq-question">What amenities are included in your hotel?</button>
    <div class="faq-answer">
        <p>Your stay includes access to complimentary Wi-Fi, a swimming pool, fitness center, in-room dining, and concierge services. Additional premium services are available upon request.</p>
    </div>
</div>

<div class="faq-item">
    <button class="faq-question">How can I modify or cancel my reservation?</button>
    <div class="faq-answer">
        <p>You Have to contact the staff. Once request staff will cancle your reservation also you will recieve an email confirming cancellation of your reservation</p>
    </div>
</div>

<div class="faq-item">
    <button class="faq-question">Are there any special discounts for long stays?</button>
    <div class="faq-answer">
        <p>Yes, we offer special rates for extended stays and early bookings. Visit our "Offers & Promotions" page or contact our reservations team for more details.</p>
    </div>
</div>

<div class="faq-item">
    <button class="faq-question">Can I book a local transport from the hotel?</button>
    <div class="faq-answer">
        <p>Yes, of course You can book a ride through our website or inquire at the reception desk upon arrival.</p>
    </div>
</div>

<div class="faq-item">
    <button class="faq-question">How do I book a dining experience at the hotel restaurant?</button>
    <div class="faq-answer">
        <p>You can reserve a table at our restaurant through the "Dining" section on our website or by calling the front desk. Special dining experiences and private bookings are also available.</p>
    </div>
</div>
</div>


    <script>
    document.querySelectorAll('.faq-question').forEach(button => {
        button.addEventListener('click', () => {
            const faqItem = button.parentElement;
            faqItem.classList.toggle('active');
        });
    });
    </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="profile_modal.js"></script>

<script src="//code.tidio.co/qmd9ruzjvfcqnfgzj9rp2vfrhr4yfr82.js" async></script>


    </body>
</html>