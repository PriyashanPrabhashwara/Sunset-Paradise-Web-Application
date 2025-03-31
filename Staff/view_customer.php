<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
           
        }

        .container {
            max-width: 1260px;
            margin-left: 250px;
           
            background: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            text-align: left;
        }

        th, td {
            padding: 12px;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        img{
            width:97%;
            height: 100px;
        }

        .btn-edit {
            background-color: #ffc107;
            color: black;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-add {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .btn-edit:hover { background-color: #e0a800; }
       
    </style>
</head>
<body>

<?php include 'sidebar.php'; ?>

    <div class="container">
        <h2>View Customers</h2>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Password</th>
                        <th>Gender</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Connect to database
                    include 'dbc.php';

                    $sql = "SELECT * FROM customers";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['User_ID']}</td>
                                    <td>{$row['CustomerName']}</td>
                                    <td>{$row['Email']}</td>
                                    <td>{$row['Number']}</td>
                                    <td>{$row['Password']}</td>
                                    <td>{$row['Gender']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No Users found</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>