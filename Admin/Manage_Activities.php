<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Activities</title>
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
        <h2>Manage Activities</h2>
        <button class="btn-add" onclick="addactivity()">+ Add New Activites</button>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Schedule</th>
                        <th>Location</th>
                        <th>Price (Rs)</th>
                        <th>Image</th>
                        <th>Duration</th>
                        <th>Requirements</th>
                        <th>Offers</th>
                        <th style="width: 13%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Connect to database
                    include 'dbc.php';

                    $sql = "SELECT * FROM activities";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['schedule']}</td>
                                    <td>{$row['location']}</td>
                                    <td>{$row['price']}</td>
                                   <td><img src={$row['image_url']}></td>
                                   <td>{$row['duration']}</td>
                                   <td>{$row['requirements']}</td>
                                   <td>{$row['special_offers']}</td>
                                    
                                    <td>
                                        <button class='btn-edit' onclick='editactivity({$row['id']})'>Edit</button>
                                        <button class='btn-delete' onclick='deleteactivity({$row['id']})'>Delete</button>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No food items found</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    function addactivity() {
        Swal.fire({
            title: "Add New Activity",
            html: `
                <input id="name" class="swal2-input" placeholder="Activity Name">
                <input id="description" class="swal2-input" placeholder="Description">
                <input id="schedule" class="swal2-input" placeholder="Schedule">
                <input id="location" class="swal2-input" placeholder="Location">
                <input id="price" class="swal2-input" placeholder="Price (Rs)">
                <input id="image_url" class="swal2-input" placeholder="Image URL">
                <input id="duration" class="swal2-input" placeholder="Duration">
                <input id="requirements" class="swal2-input" placeholder="Requirements">
                <input id="special_offers" class="swal2-input" placeholder="Special Offers">
            `,
            showCancelButton: true,
            confirmButtonText: "Add",
            preConfirm: () => {
                let data = {
                    name: document.getElementById("name").value,
                    description: document.getElementById("description").value,
                    schedule: document.getElementById("schedule").value,
                    location: document.getElementById("location").value,
                    price: document.getElementById("price").value,
                    image_url: document.getElementById("image_url").value,
                    duration: document.getElementById("duration").value,
                    requirements: document.getElementById("requirements").value,
                    special_offers: document.getElementById("special_offers").value
                };

                return $.post("add-activity.php", data, function(response) {
                    Swal.fire("Success", response, "success").then(() => location.reload());
                }).fail(function() {
                    Swal.fire("Error", "Failed to add activity", "error");
                });
            }
        });
    }

    function editactivity(activityId) {
        $.get("get-activity.php?id=" + activityId, function(data) {
            let activity = JSON.parse(data);
            Swal.fire({
                title: "Edit Activity",
                html: `
                    <input id="name" class="swal2-input" value="${activity.name}">
                    <input id="description" class="swal2-input" value="${activity.description}">
                    <input id="schedule" class="swal2-input" value="${activity.schedule}">
                    <input id="location" class="swal2-input" value="${activity.location}">
                    <input id="price" class="swal2-input" value="${activity.price}">
                    <input id="image_url" class="swal2-input" value="${activity.image_url}">
                    <input id="duration" class="swal2-input" value="${activity.duration}">
                    <input id="requirements" class="swal2-input" value="${activity.requirements}">
                    <input id="special_offers" class="swal2-input" value="${activity.special_offers}">
                `,
                showCancelButton: true,
                confirmButtonText: "Save",
                preConfirm: () => {
                    let data = {
                        id: activityId,
                        name: document.getElementById("name").value,
                        description: document.getElementById("description").value,
                        schedule: document.getElementById("schedule").value,
                        location: document.getElementById("location").value,
                        price: document.getElementById("price").value,
                        image_url: document.getElementById("image_url").value,
                        duration: document.getElementById("duration").value,
                        requirements: document.getElementById("requirements").value,
                        special_offers: document.getElementById("special_offers").value
                    };

                    $.post("edit-activity.php", data, function(response) {
                        Swal.fire("Success", response, "success").then(() => location.reload());
                    }).fail(function() {
                        Swal.fire("Error", "Failed to update activity", "error");
                    });
                }
            });
        });
    }

    function deleteactivity(activityId) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won’t be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.get("delete-activity.php?id=" + activityId, function(response) {
                    Swal.fire("Deleted!", response, "success").then(() => location.reload());
                }).fail(function() {
                    Swal.fire("Error", "Failed to delete activity", "error");
                });
            }
        });
    }
</script>


</body>
</html>
