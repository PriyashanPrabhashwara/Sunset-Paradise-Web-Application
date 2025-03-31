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
            max-width: 1200px;
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
        <h2>Manage Room Details</h2>
        <button class="btn-add" onclick="openAddRoomModal()">+ Add New Room</button>
        <div class="table-container">
            <table><thead>
                    <tr>
                        <th>ID</th>
                        <th>Room Name</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Amenities</th>
                        <th>Occupancy</th>
                        <th>Size</th>
                        <th>Price (Rs)</th>
                        <th style="width: 13%;">Actions</th>
                    </tr>
                </thead><tbody>
                    <?php
                    include 'dbc.php';
                    $sql = "SELECT * FROM rooms";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['category']}</td>
                                    <td>{$row['description']}</td>
                                    <td>{$row['amenities']}</td>
                                    <td>{$row['occupancy']}</td>
                                    <td>{$row['size']}</td>
                                    <td>{$row['price']}</td>
                                    <td>
                                        <button class='btn-edit' onclick='editRoom({$row['id']})'>Edit</button>
                                        <button class='btn-delete' onclick='deleteRoom({$row['id']})'>Delete</button>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No rooms found</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
       function editRoom(roomId) {
    $.get("get-room.php?id=" + roomId, function(data) {
        let room = JSON.parse(data);
        Swal.fire({
            title: "Edit Room",
            html: `
                <input id="name" class="swal2-input" value="${room.name}">
                <input id="category" class="swal2-input" value="${room.category}">
                <input id="description" class="swal2-input" value="${room.description}">
                <input id="amenities" class="swal2-input" value="${room.amenities}">
                <input id="other_amenities" class="swal2-input" value="${room.other_amenities}">
                <input id="occupancy" class="swal2-input" value="${room.occupancy}">
                <input id="size" class="swal2-input" value="${room.size}">
                <input id="image_url" class="swal2-input" value="${room.image_url}">
                <input id="price" class="swal2-input" value="${room.price}">
            `,
            showCancelButton: true,
            confirmButtonText: "Save",
            preConfirm: () => {
                let data = {
                    id: roomId,
                    name: document.getElementById("name").value,
                    category: document.getElementById("category").value,
                    description: document.getElementById("description").value,
                    amenities: document.getElementById("amenities").value,
                    other_amenities: document.getElementById("other_amenities").value,
                    occupancy: document.getElementById("occupancy").value,
                    size: document.getElementById("size").value,
                    image_url: document.getElementById("image_url").value,
                    price: document.getElementById("price").value
                };

                $.post("edit-room.php", data, function(response) {
                    Swal.fire("Success", response, "success").then(() => location.reload());
                });
            }
        });
    });
}

        function deleteRoom(roomId) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won’t be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.get("delete-room.php?id=" + roomId, function(response) {
                Swal.fire("Deleted!", response, "success").then(() => location.reload());
            });
        }
    });
}

        function openAddRoomModal() {
    Swal.fire({
        title: "Add New Room",
        html: `
            <input id="name" class="swal2-input" placeholder="Room Name">
            <input id="category" class="swal2-input" placeholder="Category">
            <input id="description" class="swal2-input" placeholder="Description">
            <input id="amenities" class="swal2-input" placeholder="Amenities">
            <input id="other_amenities" class="swal2-input" placeholder="Other Amenities">
            <input id="occupancy" class="swal2-input" placeholder="Occupancy">
            <input id="size" class="swal2-input" placeholder="Size">
            <input id="image_url" class="swal2-input" placeholder="Image">
            <input id="price" class="swal2-input" placeholder="Price">
        `,
        showCancelButton: true,
        confirmButtonText: "Add",
        preConfirm: () => {
            let data = {
                name: document.getElementById("name").value,
                category: document.getElementById("category").value,
                description: document.getElementById("description").value,
                amenities: document.getElementById("amenities").value,
                other_amenities: document.getElementById("other_amenities").value,
                occupancy: document.getElementById("occupancy").value,
                size: document.getElementById("size").value,
                image_url: document.getElementById("image_url").value,
                price: document.getElementById("price").value
            };

            $.post("add-room.php", data, function(response) {
                Swal.fire("Success", response, "success").then(() => location.reload());
            });
        }
    });
}
    </script>

</body>
</html>
