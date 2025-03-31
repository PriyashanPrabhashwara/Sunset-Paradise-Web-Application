<!-- manage_staff.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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

<?php include 'sidebar.php'?>

<div class="container">
    <h2>Manage Staff</h2>
    <button class="btn-add" onclick="addStaff()">+ Add New Staff</button>

    <table class="table-container">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Password</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="staffTable">
            <?php
            include 'dbc.php';
            $sql = "SELECT * FROM staff";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr id='row_{$row['id']}'>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['password']}</td>
                            <td>
                                <button class='btn-edit' onclick='editStaff({$row['id']})'>Edit</button>
                                <button class='btn-delete' onclick='deleteStaff({$row['id']})'>Delete</button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No staff members found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<script>
function addStaff() {
    Swal.fire({
        title: "Add Staff",
        html: `
            <input id="name" class="swal2-input" placeholder="Full Name">
            <input id="email" class="swal2-input" placeholder="Email">
            <input id="username" class="swal2-input" placeholder="Username">
            <input id="password" type="password" class="swal2-input" placeholder="Password">
        `,
        showCancelButton: true,
        confirmButtonText: "Add",
        preConfirm: () => {
            let data = {
                name: document.getElementById("name").value,
                email: document.getElementById("email").value,
                username: document.getElementById("username").value,
                password: document.getElementById("password").value
            };
            return $.post("add_staff.php", data, function(response) {
                Swal.fire("Success", response, "success").then(() => location.reload());
            }).fail(() => {
                Swal.fire("Error", "Failed to add staff", "error");
            });
        }
    });
}

function editStaff(staffId) {
    $.get("get_staff.php?id=" + staffId, function(data) {
        let staff = JSON.parse(data);
        Swal.fire({
            title: "Edit Staff",
            html: `
                <input id="name" class="swal2-input" value="${staff.name}">
                <input id="email" class="swal2-input" value="${staff.email}">
                <input id="username" class="swal2-input" value="${staff.username}">
                <input id="password" type="password" class="swal2-input" value="${staff.password}">
            `,
            showCancelButton: true,
            confirmButtonText: "Save",
            preConfirm: () => {
                let data = {
                    id: staffId,
                    name: document.getElementById("name").value,
                    email: document.getElementById("email").value,
                    username: document.getElementById("username").value,
                    password: document.getElementById("password").value
                };
                $.post("edit_staff.php", data, function(response) {
                    Swal.fire("Success", response, "success").then(() => location.reload());
                }).fail(() => {
                    Swal.fire("Error", "Failed to update staff", "error");
                });
            }
        });
    });
}

function deleteStaff(staffId) {
    Swal.fire({
        title: "Are you sure?",
        text: "This action cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.get("delete_staff.php?id=" + staffId, function(response) {
                Swal.fire("Deleted!", response, "success").then(() => location.reload());
            });
        }
    });
}
</script>

</body>
</html>
