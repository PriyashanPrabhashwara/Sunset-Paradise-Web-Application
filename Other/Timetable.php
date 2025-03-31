

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class & Personal Training Timetable</title>
    <link rel="stylesheet" href="Timetable.css?v=<?php echo time(); ?>">
</head>
<body>

<header>



<nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="Timetable.php">Services</a></li>
                <li><a href="Reservation.php">Reservations</a></li>
                <li><a href="Register.php">Register</a></li>
                <li><a href="wedding.php">Wedding</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="FAQ.php">FAQ</a></li>
                <li><a href="Dining.php">Dining</a></li>  
                <li><a href="shop.php">Order Online</a></li>
                <li><a href="Rating.php">Rate Us</a></li>            
            </ul>
        </nav>


</header>

    <!-- table for details -->

    <h2 style="color: #ff6347;">Classes-Info</h2>

    <table class="info">
    <tr>
        <th>Class</th>
        <th>Benifits</th>
        <th>Progression</th>
        <th>Trainer-Info</th>
        <th>Training Packages</th>
    </tr>

    <tr>
        <td>
            <h2>Yoga</h2>
            <img src="yoga.jpg" width="250px">
        </td>
        <td>
            <ul>
                <li>Improve flexibility and posture</li>
                <li>Reduce stress and enhance mental clarity</li>
                <li>Strengthen core muscles</li>
            </ul>
        </td>
        <td>
            <p><span style="color:white">Beginner to Advanced</span><br><br>
            Start with basic poses and breathing exercises, then progress to more complex asanas as your flexibility and strength improve. Instructors provide modifications for all levels, ensuring you can advance at your own pace.
        </p>
        </td>
        <td>
            <p>
            Jane Doe is a certified yoga instructor with over 7 years of experience. She specializes in Hatha and Vinyasa yoga, focusing on proper alignment and breathing techniques to improve both physical and mental health. Jane is passionate about helping her students find inner peace through mindful practice.
            </p>
        </td>
        <td>
            <ul>
               <li>Drop-in Class: $5 per session</li> 
               <li>5-Class Package: $10 (Save 13%)</li>
               <li>10-Class Package: $20 (Save 20%)</li>
               <li>Monthly Unlimited Package: $25</li>
            </ul>
        </td>
    </tr>

    <tr>
        <td>
            <h2>Zumba</h2>
            <img src="zumba.jpg" width="250px">
        </td>
        <td>
            <ul>
                <li>Burn calories in a fun, social environment</li>
                <li>Improve coordination and endurance</li>
                <li>Tone muscles through rhythmic movements</li>
            </ul>
        </td>
        <td>
            <p><span style="color:white">All Levels</span><br><br>
            No dance experience is needed! The intensity can be modified to match your fitness level. As you attend more classes, you’ll naturally improve your coordination and stamina.
        </p>
        </td>
        <td>
            <p>
            John Smith is an energetic Zumba instructor with a passion for dance and fitness. His classes are filled with high-energy moves, positive vibes, and Latin-inspired rhythms. John has been teaching for over 5 years and is known for his contagious enthusiasm
            </p>
        </td>
        <td>
            <ul>
               <li>Drop-in Class: $6 per session</li> 
               <li>5-Class Package: $11 (Save 15%)</li>
               <li>10-Class Package: $18 (Save 20%)</li>
               <li>Monthly Unlimited Package: $22</li>
            </ul>
        </td>
    </tr>

    <tr>
        <td>
            <h2>HIIT</h2>
            <img src="hitt.PNG" width="250px">
        </td>
        <td>
            <ul>
                <li>Burn fat efficiently with high-intensity bursts</li>
                <li>Increase endurance and boost metabolism</li>
                <li>Improve overall strength and cardio capacity</li>
            </ul>
        </td>
        <td>
            <p><span style="color:white">Intermediate to Advanced</span><br><br>
            Start with lower-intensity intervals and gradually build up to more intense movements. Each session will push you to your limits, with options to modify exercises based on your ability
        </p>
        </td>
        <td>
            <p>
                Nishan Herat is Certified HIIT & Strength Training Expert with over 10 years of experience. Nishan is passionate about helping people build strength and endurance, offering personalized training sessions that get results.
            </p>
        </td>
        <td>
            <ul>
               <li>Single Class: $10 per session</li> 
               <li>5-Class Package: $15 (Save 13%)</li>
               <li>10-Class Package: $20 (Save 20%)</li>
               <li>Monthly Unlimited Package: $25</li>
            </ul>
        </td>
    </tr>

    <tr>
        <td>
            <h2>Personal Training</h2>
            <img src="pt.jpg" width="250px">
        </td>
        <td>
            <ul>
                <li>Tailored workouts specific to your fitness goals</li>
                <li>Learn proper form and technique</li>
                <li>Receive personalized nutrition and workout advice</li>
            </ul>
        </td>
        <td>
            <p><span style="color:white">Custom</span><br><br>
            Your trainer will assess your current fitness level and create a progressive workout plan designed to achieve your specific goals, with regular check-ins to ensure progress
        </p>
        </td>
        <td>
            <p>
            Avishka Senevirathana is a NASM-certified personal trainer with 10 years of experience in strength training, fat loss, and muscle building. Mark creates custom workout plans tailored to each client’s fitness goals, ensuring that every session is effective and results-driven
            </p>
        </td>
        <td>
            <ul>
               <li>Single Personal Training Session: $10 per session</li> 
               <li>5-Class Package: $15 (Save 6%)</li>
               <li>10-Class Package: $20 (Save 8%)</li>
               <li>Small Group Training: $35 per person per session (groups of 3-5)</li>
            </ul>
        </td>
    </tr>

    </table>

    <!-- Personal training categories -->

    <section class="personal-training-section">
    <h2>Personal Training Options</h2>
    <div class="training-options">
        <div class="training-card">
            <img src="https://basefitness.us/wp-content/uploads/2022/04/MicrosoftTeams-image-20-scaled.jpg" alt="Strength Training" class="training-image">
            <h3>Strength Training</h3>
            <p>Build muscle and enhance overall strength with resistance exercises and progressive techniques.</p>
        </div>
        <div class="training-card">
            <img src="https://www.mensjournal.com/.image/ar_16:9%2Cc_fill%2Ccs_srgb%2Cfl_progressive%2Cg_faces:center%2Cq_auto:good%2Cw_620/MjA5MjM2NjAxMzI1MjMzNzc2/weight-loss-exercise-plan.jpg" alt="Weight Loss & Fat Reduction" class="training-image">
            <h3>Weight Loss & Fat Reduction</h3>
            <p>High-intensity workouts and custom nutrition guidance for effective weight loss.</p>
        </div>
        <div class="training-card">
            <img src="https://www.planetfitness.com/sites/default/files/feature-image/SEO%20Blog%20Article_Header%20Image_12%20Functional%20Fitness%20Exercises%20to%20Build%20Strength.jpg" alt="Functional Fitness" class="training-image">
            <h3>Functional Fitness</h3>
            <p>Improve mobility, balance, and flexibility for easier daily movement.</p>
        </div>
        <div class="training-card">
            <img src="https://images.squarespace-cdn.com/content/v1/513b8821e4b0df53688ed53d/ed24d473-dee4-435f-a2f2-a62a3b0e1162/strength-training-for-athletes-05.jpeg" alt="Sports-Specific Training" class="training-image">
            <h3>Sports-Specific Training</h3>
            <p>Targeted workouts for enhancing agility, endurance, and power in various sports.</p>
        </div>
        
    </div>
</section>

<!-- Other services -->

<section class="personal-training-section" style="margin-top: -35px;">
    <h2>Other Services</h2>
    <div class="training-options">
        <div class="training-card">
            <img src="https://www.cozmoderm.com/wp-content/uploads/elementor/thumbs/nutrition-counseling-pqtttlwwh9nzkd7ppvtk0l0tfpnn3puiwlqyi77n5s.jpg" alt="Strength Training" class="training-image">
            <h3>Nutrition and Dietary Counseling</h3>
            <p>Personalized diet plans, nutritional coaching, and support to meet fitness goals.</p>
        </div>
        <div class="training-card">
            <img src="https://cdn-res.keymedia.com/cms/images/ca/159/0422_638602756621152788.jpg" class="training-image">
            <h3>Wellness Programs</h3>
            <p>Mindfulness and Meditation Sessions and Stress Management Workshops.</p>
        </div>
        <div class="training-card">
            <img src="https://powerliftingtechnique.com/wp-content/uploads/2021/12/Crunch-Fitness-Childcare-Services.jpg" alt="Functional Fitness" class="training-image">
            <h3>Childcare Services</h3>
            <p>On-site childcare or kids' play areas to make gym visits more convenient for parents.</p>
        </div>
        <div class="training-card">
            <img src="https://images.ctfassets.net/zx26b3gn0tiy/27BLI4MzVIOeH3uk1SBBjR/3c0a412d33764ccb23777ac13f153fd1/lappset-ten-reasons-why-outdoor-training-1600-600-1.jpg" alt="Sports-Specific Training" class="training-image">
            <h3>Sports and Recreational Activities</h3>
            <p>Organized games and activities such as basketball, squash, swimming, or martial arts training.</p>
        </div>
        
    </div>
</section>

    <!-- Timetable for booking -->
    <div class="timetable-container">
        <h2 style="color: white;">Session Timetable</h2>
        <table class="timetable">
            <thead style="background-color: #ff6347;">
                <tr>
                    <th>Day</th>
                    <th>Yoga</th>
                    <th>Zumba</th>
                    <th>HIIT</th>
                    <th>Personal Training</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP will inject the table rows here -->
            <?php
                
                // database connection
               include 'dbc.php';

                //  Write SQL query
                $sql = "SELECT Day,Yoga,Zumba,HITT,PT FROM timetable"; // Replace with your table and columns
                $result = $conn->query($sql);
                ?>

                <?php if ($result->num_rows > 0): ?>
                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td><?php echo $row["Day"]; ?></td>
                            <td><?php echo $row["Yoga"]; ?></td>
                            <td><?php echo $row["Zumba"]; ?></td>
                            <td><?php echo $row["HITT"]; ?></td>
                            <td><?php echo $row["PT"]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No records found</td>
                    </tr>
                <?php endif; ?>
                
            </tbody>
            
        </table>

        <a class="btn1" href="classbook.php">Book</a>
</body>
</html>
<?php $conn->close(); // Close the database connection ?>