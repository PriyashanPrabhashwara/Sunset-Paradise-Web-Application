<?php

// Start a session
session_start();

include 'dbc.php';

$message="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password from the form
    $username = $_POST['name'];
    $password = $_POST['password'];


    // Prepare and execute SQL statement to get the user by email
    $sql = "SELECT * FROM admin WHERE Username = ? AND Password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username,$password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
       
        
        $_SESSION['username'] = $_POST['name'];
        header("Location: adminmenu.php");
        exit();
       
    } else {
        $message = "Invalid Login";
    }

    // Close the database connection
    $conn->close();
}
?>

<html>
<head>
    <link rel="stylesheet" href="register.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>

<a href="adminmenu.php"><img src="logo.png" width="60px" style="border-radius: 10px;"> </a>

<div class="container" style="margin-top:140px;">
        <h2 style="color:coral;text-align:center;">Admin Login</h2>
        <form action="adminlog.php" method="POST">
            <label for="name">Username:</label>
            <input type="text" id="name" name="name" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login"></input>
        </form>

        <!-- Display error message if exists -->  
        <h2 style="color: orangered;text-align:center;"><?php echo $message?></h2>     
    </div>
</body>
</html>