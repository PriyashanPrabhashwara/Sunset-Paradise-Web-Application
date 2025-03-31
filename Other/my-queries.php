<?php
session_start();
include 'dbc.php'; // Include your database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch the user's queries and responses
$stmt = $conn->prepare("SELECT * FROM queries WHERE User_ID = ? ORDER BY QueryDate DESC");
$stmt->bind_param("s", $user_id); // Bind user ID to query
$stmt->execute();
$result = $stmt->get_result(); // Fetch the result set

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Queries</title>
    <link rel="stylesheet" href="queries.css?v=<?php echo time(); ?>"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>

<div class="container">
    <h1>My Queries</h1>

    <a href="home.php"><i class="fas fa-home home-icon"></i></a>



    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="query-section">
                <div class="query-box">
                    <h2>Your Query:</h2>
                    <p><?php echo $row['Message']; ?></p>
                </div>
                <div class="response-box">
                    <h2>Response:</h2>
                    <p><?php
                            if (!empty($row['Response'])) {
                                echo ($row['Response']);
                            } else {
                                echo 'Response Yet to Come';
                            }
                        ?>
                    </p>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>You have not submitted any queries yet.</p>
    <?php endif; ?>

</div>

</body>
</html>