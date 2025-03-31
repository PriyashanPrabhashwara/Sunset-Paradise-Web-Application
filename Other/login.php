<?php
// Start a session
session_start();
include 'dbc.php';
$message="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password from the form
    $id = $_POST['id'];
    $password = $_POST['password'];

    // Prepare and execute SQL statement to get the user by email
    $sql = "SELECT CustomerName FROM customers WHERE User_ID = ? AND Password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $id,$password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
       
        $_SESSION['user_id'] = $_POST['id'];
        $_SESSION['full_name'] = $row['CustomerName'];

        header("Location: home.php");
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

    <title>User-Login</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <style>

    body {
    font-family: Arial, sans-serif;
    background: url('https://www.highreshdwallpapers.com/wp-content/uploads/2014/08/Beautiful-Beach-Side-View-1280x960.jpg') no-repeat center center/cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 116%;
    background: rgba(0, 0, 0, 0.6); /* Adjust the opacity (0.6) as needed */
    z-index: -1;
}

.container {
    background: rgba(0, 0, 0, 0.6);
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
    width: 350px;
    text-align: center;
}

h2 {
    color: coral;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    color: white;
    text-align: left;
    margin-bottom: 5px;
    font-size: 18px;
}

input[type="text"], input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: none;
    border-radius: 5px;
    background: white;
    font-size: 16px;
}

input[type="submit"] {
    width: 100%;
    background-color:rgb(243, 135, 3);
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

input[type="submit"]:hover {
    background-color:rgb(242, 63, 9);
}

.error-message {
    color: orangered;
    margin-top: 10px;
    font-weight: bold;
}

        </style>
</head>
<body>
<div class="container">
    <h2>Member Login</h2>
    <form action="login.php" method="POST">
        <label for="id">User ID</label>
        <input type="text" id="id" name="id" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>

    <!-- Display error message if exists -->
    <h2 class="error-message"><?php echo $message ?></h2>
</div>
</body>
</html>


