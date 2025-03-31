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

        h2 {text-align: center;margin-bottom: 20px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {width: 100%;border-collapse: collapse;margin-top: 20px;}
        table, th, td {border: 1px solid #ddd;text-align: left;}
        th, td {padding: 12px;}
        th {background-color: #007bff;color: white;}
        img{width:97%;height: 100px;}

        .btn-edit {
            background-color: #ffc107;
            color: black;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-edit:hover { background-color: #e0a800; }

        </style>
</head>

<body>

<?php include 'sidebar.php'; ?>

    <div class="container">
        <h2>Transport Info</h2>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                    <th>Booking ID</th>
                    <th>User ID</th>
                    <th>Destination</th>
                    <th>Date</th>
                    <th>Vehicle</th>
                    <th>Fare (Rs)</th>
                    <th>Vehicle Image</th>
                    <th>Booking Time</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'dbc.php';
                    $sql = "SELECT booking_id, User_ID, destination, date, vehicle, fare, vehicle_image, booking_time FROM transport";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['booking_id']}</td>
                                    <td>{$row['User_ID']}</td>
                                    <td>{$row['destination']}</td>
                                    <td>{$row['date']}</td>
                                    <td>{$row['vehicle']}</td>
                                    <td>{$row['fare']}</td>
                                    <td><img src={$row['vehicle_image']}></td>
                                    <td>{$row['booking_time']}</td>                                
                                    <td><button class='btn-edit' onclick='notifyUser({$row['booking_id']}, \"{$row['User_ID']}\")'>Respond</button></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No Bookings found</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>

function notifyUser(bookingId, userId) {
    Swal.fire({
        title: "Driver Availability",
        html: `
            <label for="driverAvailable">Is a driver available?</label>
            <select id="driverAvailable" class="swal2-input">
                <option value="select">Select</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
            <div id="driverDetails" style="display: none;">
                <input type="text" id="driverName" class="swal2-input" placeholder="Driver Name">
                <input type="text" id="arrivalTime" class="swal2-input" placeholder="Estimated Arrival Time">
                <input type="text" id="driverContact" class="swal2-input" placeholder="Driver Contact">
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: "Send Email",
        cancelButtonText: "Cancel",
        preConfirm: () => {
            const driverAvailable = document.getElementById("driverAvailable").value;
            if (driverAvailable === "yes") {
                const driverName = document.getElementById("driverName").value.trim();
                const arrivalTime = document.getElementById("arrivalTime").value.trim();
                const driverContact = document.getElementById("driverContact").value.trim();
                if (!driverName || !arrivalTime || !driverContact) { 
                    Swal.showValidationMessage("All fields must be filled if a driver is available.");
                    return false;
                }
                return {
                    available: true,
                    driverName: driverName,
                    arrivalTime: arrivalTime,
                    driverContact: driverContact,
                    userId: userId,
                    bookingId: bookingId
                };
            } else if (driverAvailable === "no") {
                return { available: false, userId: userId, bookingId: bookingId };
            } else {
                Swal.showValidationMessage("Please select if a driver is available.");
                return false;
            }
        }
    }).then((result) => {
        if (result.isConfirmed && result.value) {  // ✅ Ensure valid data before sending
            sendDriverNotification(result.value);
        }
    });

    document.getElementById("driverAvailable").addEventListener("change", function () {
        document.getElementById("driverDetails").style.display = this.value === "yes" ? "block" : "none";
    });
}

function sendDriverNotification(data) {
    fetch("send_driver_notification.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            Swal.fire("Success!", "User has been notified.", "success");
        } else {
            Swal.fire("Error", result.message || "Failed to send email.", "error");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        Swal.fire("Error", "An unexpected error occurred.", "error");
    });
}
</script>

</body>
</html>