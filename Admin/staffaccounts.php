
<?php

// Start a session
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: adminlog.php");
    exit;
}

include 'dbc.php';

$message="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password from the form
    $username = $_POST['name'];
    $password = $_POST['password'];


    // Prepare and execute SQL statement to get the user by email
    $stmt = $conn->prepare("INSERT INTO staff (Username,Password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username,$password);
    

    if($stmt->execute()){
        $message="Account Sucessfully Created";
    }

    // Close the database connection and the statement
    $stmt->close();
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
        <h2 style="color:coral;text-align:center;">Create Accounts</h2>
        <form action="staffaccounts.php" method="POST">
            <label for="name">Username:</label>
            <input type="text" id="name" name="name" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Submit"></input>
        </form>

        <!-- Display error message if exists -->  
        <h2 style="color: orangered;text-align:center;"><?php echo $message?></h2>     
    </div>
</body>
</html>