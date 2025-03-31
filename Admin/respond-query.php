<?php
include 'dbc.php';

// Fetch query details using the ID
$id = $_GET['id'];
$query = $conn->query("SELECT * FROM queries WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = $_POST['response'];
    $stmt = $conn->prepare("UPDATE queries SET response = ? WHERE id = ?");
    $stmt->bind_param("si", $response, $id);
    $stmt->execute();

    header("Location: adminmenu.php?message3=Respond Added");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Respond to Query</title>
    <link rel="stylesheet" href="register.css?v=<?php echo time(); ?>">
</head>
<body>
    <h1>Respond to User Query</h1><br>
    <br><br><br>
    <div class="container">
    <form action="respond-query.php?id=<?php echo $id; ?>" method="post">
        <label for="response">Your Response:</label>
        <textarea id="response" name="response" required></textarea>
        <input type="submit" value="Submit">
    </form>
    </div>
</body>
</html>
