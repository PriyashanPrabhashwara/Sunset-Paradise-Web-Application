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

    header("Location: manage_query.php?message3=Respond Added");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Respond to Query</title>
    
    <style>
        /* General Page Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Container */
        .container {
            width: 90%;
            max-width: 500px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
            text-align: left;
            display: block;
        }

        textarea {
            width: 95%;
            height: 120px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
            transition: border 0.3s ease-in-out;
        }

        textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Submit Button */
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            font-size: 16px;
            font-weight: bold;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 15px;
            }

            textarea {
                height: 100px;
            }
        }
    </style>
</head>
<body>
    
    <div class="container">
        <h1>Respond to User Query</h1>
        <form action="respond-query.php?id=<?php echo $id; ?>" method="post">
            <label for="response">Your Response:</label>
            <textarea id="response" name="response" required></textarea>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
