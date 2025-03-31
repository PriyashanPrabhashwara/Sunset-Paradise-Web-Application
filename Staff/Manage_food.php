<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Room Details</title>
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
        .btn-delete:hover { background-color: #c82333; }
        .btn-add:hover { background-color: #218838; }
    </style>
</head>
<body>

<?php include 'sidebar.php'; ?>

    <div class="container">
        <h2>Manage Food Details</h2>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Food Name</th>
                        <th>Categoty ID</th>
                        <th>Stock</th>
                        <th>Description</th>
                        <th>Price (Rs)</th>
                        <th>Image</th>
                        <th style="width: 13%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Connect to database
                    include 'dbc.php';

                    $sql = "SELECT * FROM foods";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['Category']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['category_id']}</td>
                                    <td>{$row['quantity']}</td>
                                    <td>{$row['description']}</td>
                                    <td>{$row['price']}</td>
                                    <td><img src={$row['image']}></td>
                                    
                                    <td>
                                        <button class='btn-edit' onclick='editfood({$row['id']})'>Edit</button>
                                        <button class='btn-delete' onclick='deletefood({$row['id']})'>Delete</button>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No food items found</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
      function editfood(foodId) {
    $.get("get-food.php?id=" + foodId, function(data) {
        let food = JSON.parse(data);
        Swal.fire({
            title: "Edit Food Items",
            html: `
                <input id="category" class="swal2-input" value="${food.Category}">
                <input id="name" class="swal2-input" value="${food.name}">
                <input id="category_id" class="swal2-input" value="${food.category_id}">
                <input id="quantity" class="swal2-input" value="${food.quantity}">
                <input id="price" class="swal2-input" value="${food.price}">
                <input id="image_url" class="swal2-input" value="${food.image}">
                <input id="description" class="swal2-input" value="${food.description}">
            `,
            showCancelButton: true,
            confirmButtonText: "Save",
            preConfirm: () => {
                let data = {
                    id: foodId,
                    category: document.getElementById("category").value,
                    name: document.getElementById("name").value,
                    category_id: document.getElementById("category_id").value, 
                    quantity: document.getElementById("quantity").value,     
                    price: document.getElementById("price").value, 
                    image: document.getElementById("image_url").value,  // Fixed ID name              
                    description: document.getElementById("description").value          
                };

                $.post("edit-food.php", data, function(response) {
                    Swal.fire("Success", response, "success").then(() => location.reload());
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    Swal.fire("Error", "Failed to update: " + textStatus, "error");
                });
            }
        });
    });
}

        function deletefood(foodId) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won’t be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.get("delete-food.php?id=" + foodId, function(response) {
                Swal.fire("Deleted!", response, "success").then(() => location.reload());
            });
        }
    });
}

    </script>

</body>
</html>
