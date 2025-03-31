
<?php
include 'dbc.php'; 

$rooms = [];

// Fetch room names from the database
$query = "SELECT name FROM rooms";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rooms[] = $row['name'];
    }
}

 if(isset( $_SESSION['user_id'])){
    $uid=$_SESSION['user_id'];
 }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id = trim($_POST['id']);
    $guests = intval($_POST['guests']);
    $room_name = trim($_POST['room_name']);
    $arrival_date = $_POST['arrival_date'];
    $departure_date = $_POST['departure_date'];
    $special_requests = trim($_POST['special_requests']);

    // Check if the selected room is available for the given date range
    $check_query = "SELECT * FROM bookings 
                    WHERE room_name = ? 
                    AND (arrival_date <= ? AND departure_date >= ?)";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("sss", $room_name, $departure_date, $arrival_date);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Error: This room is already booked for the selected dates. Please choose different dates.";
    } else {
        // Insert the new booking if no conflict
        $stmt = $conn->prepare("INSERT INTO bookings ( User_ID, room_name, guests, arrival_date, departure_date, special_requests) 
                                VALUES ( ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisss", $user_id, $room_name, $guests, $arrival_date, $departure_date, $special_requests);

        if ($stmt->execute()) {
            $booking_id = $stmt->insert_id;

            header("Location: roompayment.php?booking_id=" . $booking_id);
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}
$conn->close();
?>

 <!-- to identify if the user has logged or not  -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Room</title>
    <link rel="stylesheet" href="bookings.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="rooms.css?v=<?php echo time(); ?>">
    
    
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <style>
       

        .error-message {
            color: #D8000C;
            background-color: #FFD2D2;
            border: 1px solid #D8000C;
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            display: none;
            margin-top: 5px;
            text-align: center;
            transition: opacity 0.5s ease-in-out;
            opacity: 0;
        }

        /* Show error message smoothly */
        .error-message.show {
            display: block;
            opacity: 1;
        }

        /* Warning icon */
        .error-message::before {
            content: "⚠️ ";
            font-size: 16px;
            margin-right: 5px;
        }

        </style>


</head>
<body style="background-image: url('https://i.pinimg.com/736x/8d/26/db/8d26db776f4c30ecceb99c2c30e698f8.jpg');background-size:cover;">

<div class="booking-container">
        
        <form id="bookingForm" method="POST" action="booking.php" style="flex: 1;">
        <h2>Room Booking Enquiry Form</h2><br>
            <div class="input-group">
                <label>User ID *</label>
                <input type="text" name="id" required id="uid">
                <p id="errorMessage" class="error-message">Invalid User ID. Enter a valid User ID.<br>If you have an account <a href="login.php">Login</a>.
                 If you don't have an account <a href="Register.php">Register</a></p>
            </div>
            <div class="input-group">
                <label>Select Room *</label>
                <select name="room_name" required id="roomSelect" style="width: 103%;">
                    <option value="">Please Select</option>
                    <?php foreach ($rooms as $room): ?>
                        <option value="<?= htmlspecialchars($room) ?>"><?= htmlspecialchars($room) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="input-group">
                <label>Number of Guests *</label>
                <input type="number" name="guests" placeholder="e.g., 2" required>
            </div>
            <div class="input-group">
                <label>Check In Date *</label>
                <input type="text" name="arrival_date" required>
            </div>
            <div class="input-group">
                <label>Check Out Date *</label>
                <input type="text" name="departure_date" required>
            </div>
            <div class="input-group">
                <label>Special Requests</label>
                <textarea name="special_requests" rows="4" placeholder="Any additional requests..."></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>

        <div class="header" style="flex:1">
            <div class="images">
                <img src="https://i.pinimg.com/736x/6c/88/6a/6c886a58955b62b80b29d29a69432904.jpg" alt="Room 1">
                <img src="https://i.pinimg.com/736x/b6/aa/91/b6aa915a8af1139561f0b9ec24a2e5af.jpg" alt="Room 2">
                <img src="https://i.pinimg.com/736x/00/bb/ac/00bbace43882aff6d5f5a7273911278f.jpg" alt="Room 3">
                <img src="https://i.pinimg.com/736x/98/26/94/982694e67bfff1db3e2bb79c89e184ab.jpg" alt="Room 4">
            </div>
        </div>

    </div>

    
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const roomSelect = document.querySelector("select[name='room_name']");
    const arrivalDateInput = document.querySelector("input[name='arrival_date']");
    const departureDateInput = document.querySelector("input[name='departure_date']");
    let bookedDates = [];
    let departurePicker;
    function fetchUnavailableDates(roomName) {
        fetch(`get_unavailable_dates.php?room_name=${roomName}`)
            .then(response => response.json())
            .then(data => {
                bookedDates = data || [];
                applyDatePicker();
            })
            .catch(error => console.error("Error fetching unavailable dates:", error));
    }
    function applyDatePicker() {
        flatpickr(arrivalDateInput, {
            minDate: "today",
            dateFormat: "Y-m-d",
            disable: bookedDates,
            onChange: function (selectedDates) {
                if (selectedDates.length > 0) {
                    let minDepartDate = new Date(selectedDates[0]);
                    minDepartDate.setDate(minDepartDate.getDate() + 1);
                    departurePicker.set("minDate", minDepartDate);
                }
            },
            onDayCreate: function(dObj, dStr, fp, dayElem) {
                let formattedDate = dayElem.dateObj.toLocaleDateString('en-CA'); // ✅ Fix timezone issue
                if (bookedDates.includes(formattedDate)) {
                    dayElem.style.backgroundColor = "#ff4d4d"; // 🔴 Correct booked dates
                    dayElem.style.color = "white";
                    dayElem.style.borderRadius = "5px";
                }
            }
        });
        departurePicker = flatpickr(departureDateInput, {
            minDate: "today",
            dateFormat: "Y-m-d",
            disable: bookedDates,
            onDayCreate: function(dObj, dStr, fp, dayElem) {
                let formattedDate = dayElem.dateObj.toLocaleDateString('en-CA'); // ✅ Fix timezone issue
                if (bookedDates.includes(formattedDate)) {
                    dayElem.style.backgroundColor = "#ff4d4d";
                    dayElem.style.color = "white";
                    dayElem.style.borderRadius = "5px";
                }
            }
        });
    }
    roomSelect.addEventListener("change", function () {
        let selectedRoom = this.value;
        if (selectedRoom) {
            fetchUnavailableDates(selectedRoom);
        }
    });
    applyDatePicker();
});

// dropdown select event

document.getElementById("roomSelect").addEventListener("change", function() {

    let enteredUserId = document.getElementById("uid").value.trim(); 

    fetch('check_session.php')
        .then(response => response.json())
        .then(data => {
            let errorMessage = document.getElementById("errorMessage");
            if (!data.loggedIn || enteredUserId !== data.userId) {
                errorMessage.classList.add("show"); // Smoothly show the message
            } else {
                errorMessage.classList.remove("show"); // Hide message
            }
        });
});

document.getElementById("bookingForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission first

    let enteredUserId = document.getElementById("uid").value;

    fetch('check_session.php')
        .then(response => response.json())
        .then(data => {
            if (enteredUserId === data.userId) {
                this.submit(); // Manually submit the form if the User ID matches
            }
        })
        .catch(error => console.error('Error:', error)); // Log errors if needed
});

</script>
                    


</body>
</html>