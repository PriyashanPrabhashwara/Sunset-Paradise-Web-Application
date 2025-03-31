<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Packages</title>
    <link rel="stylesheet" href="wedding.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header style="background: linear-gradient(to right, #ff7f50, #444444);">
        <h1>Our Wedding Packages</h1>
        <p>Find the perfect package for your special day.</p>
    </header>
    <main>
        
    <?php
        include('dbc.php');

        $sql = "SELECT * FROM weddingpackages";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                
                <div class='package-container'>
                    <div class='package-image'>
                        <img src='" . $row['image_url'] . "' alt='" . $row['package_name'] . "'>
                    </div>
                    <div class='package-details'>
                        <h2>" . $row['package_name'] . "</h2><br>
                        <ul class='package-features'>
                            <li><i class='fa fa-utensils'></i> Menu: " . $row['menu'] . "</li>
                            <li><i class='fa fa-users'></i> Max Guests: " . $row['max_guests'] . "</li>
                            <li><i class='fa fa-clock'></i> Duration: " . $row['duration'] . "</li>
                            
                            <li><i class='fa fa-calendar'></i> Available Dates: </li>
                        <ul class='available-dates'>";
                        
                        $dates = explode(',', $row['available_dates']); 
                        foreach ($dates as $date) {
                            echo "<li>" . trim($date) . "</li>";
                        }
                     echo "
                        </ul

                        </ul><br>
                        <p class='package-price'>Price: Rs " . $row['price'] . "</p><br>
                        <p class='package-deposit'>Deposit Required: Rs " . $row['deposit_required'] . "</p>
                        
                    </div>
                </div>
                
                ";
            }
        } else {
            echo "<p>No wedding packages found.</p>";
        }
        $conn->close();
        ?>



    </main>
</body>
</html>
