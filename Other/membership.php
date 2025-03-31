<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FitZone Fitness Center|Sri-Lanaka Gym</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="membership.css?v=<?php echo time(); ?>">
    </head>
<body>

    <!-- Navbar -->
    <header>

    <img src="logo.png" width="60px" style="border-radius: 10px;"> 

        <nav>
            <ul>
            <li><a href="home.php">Home</a></li>
                <li><a href="Timetable.php">Services</a></li>
                <li><a href="Reservation.php">Reservations</a></li>
                <li><a href="Register.php">Register</a></li>
                <li><a href="membership.php">Membership</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="FAQ.php">FAQ</a></li>
                <li><a href="blog home.php">Blog</a></li>  
                <li><a href="shop.php">Order Online</a></li>
                <li><a href="Rating.php">Rate Us</a></li>                
            </ul>
        </nav>

    <a class="btn1" href="login.php">Sign-in</a>
    <a class="btn1" href="logout.php">Sign-out</a>
    </header>

    <div class="container">
        <h1>Choose Your Membership Plan</h1>
        <div class="membership-plans">
            <!-- Basic Monthly Plan -->
            <div class="plan-card basic-plan">
                <img src="basic-monthly-logo.png" alt="Basic Monthly Logo">
                <h2>Basic Month</h2>
                <ul>
                    <li>Access to gym during off-peak hours</li>
                    <li>1 group class per week</li>
                    <li>Locker room access</li>
                    <li>Fitness assessment every 6 months</li>
                </ul>
                <p class="price">Rs.2500/month</p>
            </div>

            <!-- Premium Monthly Plan -->
            <div class="plan-card premium-plan">
                <img src="premium-monthly-logo.png" alt="Premium Monthly Logo">
                <h2>Premium Month</h2>
                <ul>
                    <li>Unlimited gym access</li>
                    <li>Unlimited group classes</li>
                    <li>1 personal training session per month</li>
                    <li>Nutrition counseling</li>
                </ul>
                <p class="price">Rs.3500/month</p>
            </div>

            <!-- Basic Quarterly Plan -->
            <div class="plan-card basic-plan">
                <img src="basic-quarterly-logo.png" alt="Basic Quarterly Logo">
                <h2>Basic Quarter</h2>
                <ul>
                    <li>Save $10 over 3 months</li>
                    <li>1 group class per week</li>
                    <li>Priority event sign-up</li>
                    <li>Free gym merchandise</li>
                </ul>
                <p class="price">Rs.6000/3 months</p>
            </div>

            <!-- Premium Quarterly Plan -->
            <div class="plan-card premium-plan">
                <img src="premium-quarterly-logo.png" alt="Premium Quarterly Logo">
                <h2>Premium Quarterly</h2>
                <ul>
                    <li>Unlimited gym access</li>
                    <li>Unlimited group classes</li>
                    <li>2 personal training sessions over 3 months</li>
                    <li>Discounted training sessions</li>
                </ul>
                <p class="price">Rs.7500/3 months</p>
            </div>

            <!-- Basic Yearly Plan -->
            <div class="plan-card basic-plan">
                <img src="basic-yearly-logo.png" alt="Basic Yearly Logo">
                <h2>Basic Year</h2>
                <ul>
                    <li>Save $90 per year</li>
                    <li>1 group class per week</li>
                    <li>2 fitness assessments per year</li>
                    <li>Discounted membership rate</li>
                </ul>
                <p class="price">Rs.11500/year</p>
            </div>

            <!-- Premium Yearly Plan -->
            <div class="plan-card premium-plan">
                <img src="premium-yearly-logo.png" alt="Premium Yearly Logo">
                <h2>Premium Year</h2>
                <ul>
                    <li>Unlimited gym access</li>
                    <li>6 personal training sessions per year</li>
                    <li>Free entry to wellness events</li>
                    <li>Priority bookings and VIP perks</li>
                </ul>
                <p class="price">Rs.14500/year</p>
            </div>
        </div>
        <br>
        <a href="Register.php" class="btn1">Join Us</a>
    </div>
</body>
</html>