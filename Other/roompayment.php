<?php
session_start();
include 'dbc.php';

if (isset($_GET['booking_id'])) {
    $booking_id = intval($_GET['booking_id']);

    // Fetch booking details
    $query = "SELECT * FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();
    } else {
        echo "Booking not found.";
        exit();
    }
    $stmt->close();
} else {
    echo "Invalid request.";
    exit();
}

$_SESSION['roomname']=$booking['room_name'];

// Fetch room details
$room_query = "SELECT * FROM rooms WHERE name = ?";
$stmt = $conn->prepare($room_query);
$stmt->bind_param("s", $booking['room_name']);
$stmt->execute();
$room_result = $stmt->get_result();

$room = $room_result->fetch_assoc();
$checkin_date = new DateTime($booking['arrival_date']);
$checkout_date = new DateTime($booking['departure_date']);
$number_of_nights = $checkin_date->diff($checkout_date)->days;

// Calculate total price
$price_per_night = $room['price'];
$total_price = $price_per_night * $number_of_nights;

$_SESSION['roomname']=$booking['room_name'];
$_SESSION['Total']=$total_price;

$user_id = $booking['User_ID'];
$email_query = "SELECT Email FROM customers WHERE User_ID = ?";
$stmt = $conn->prepare($email_query);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$email_result = $stmt->get_result();
$customer = $email_result->fetch_assoc();
$customer_email = $customer['Email'];

// Close connection
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>

    <style>
   body {
    font-family: Arial, sans-serif;
    background: #f8f8f8;
    padding: 40px;
}

.container {
    display: flex;
    max-width: 1000px;
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    margin: auto;
    gap: 25px;
}

.payment-section {
    width: 60%;
}

.summary-section {
    width: 40%;
    background: #f5f5f5;
    padding: 20px;
    border-radius: 8px;
}

.payment-options .card {
    display: flex;
    align-items: center;
    background: #fff;
    padding: 12px;
    border-radius: 5px;
    margin-bottom: 10px;
    border: 2px solid #ddd;
    cursor: pointer;
    transition: border 0.3s;
}

.payment-options .card i {
    font-size: 24px;
    margin-right: 10px;
}

.payment-options .card input {
    display: none;
}

.payment-options .card.selected {
    border: 2px solid #007bff;
    background: #f1f7ff;
}

.payment-options .card:hover {
    border: 2px solid #0056b3;
}

.add-payment {
    background: none;
    border: none;
    color: blue;
    cursor: pointer;
    margin-top: 5px;
    font-size: 14px;
}

.cancellation-policy, .ground-rules {
    margin-top: 20px;
}

h3 {
    margin-bottom: 10px;
}

.trip-summary, .pricing-breakdown {
    margin-top: 15px;
}

.trip-summary p, .pricing-breakdown p {
    display: flex;
    justify-content: space-between;
}

.confirm-pay {
    width: 100%;
    background: blue;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 20px;
}

.summary-section img {
    width: 100%;
    border-radius: 5px;
    margin-bottom: 10px;
}

.payment-container {
            text-align: center;
            margin-top: 50px;
        }

        /* Style the button */
        .confirm-pay {
            background-color: #ff6600; /* Orange color */
            color: white;
            font-size: 18px;
            padding: 12px 24px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .confirm-pay:hover {
            background-color: #e65c00; /* Darker orange */
        }

        /* Style the success message */
        .success-message {
            display: none; /* Initially hidden */
            font-size: 18px;
            color: #28a745; /* Green */
            margin-top: 15px;
            font-weight: bold;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

    </style>

</head>
<body>
    <div class="container">
        <div class="payment-section">
            <h2>Payment Method</h2>
            <div class="payment-options">
                <label class="card selected">
                    <input type="radio" name="payment" checked>
                    <i><img src="https://cdn-icons-png.flaticon.com/128/14881/14881313.png" style="width:45px;"></i>
                    
                </label>

                <label class="card">
                    <input type="radio" name="payment">
                    <i><img src="https://cdn-icons-png.flaticon.com/128/196/196578.png" style="width:45px;"></i>
                    
                    
                </label>

                <label class="card">
                    <input type="radio" name="payment">
                    <i><img src="https://cdn-icons-png.flaticon.com/128/196/196565.png" style="width:50px;"></i>
                    
                </label>

                <button class="add-payment">+ Add New Payment</button>
            </div>

            <div class="cancellation-policy">
                <h3>Cancellation Policy</h3>
                <p>Free cancellation before Nov 30. After that, the reservation is non-refundable. <a href="#">Learn more</a></p>
            </div>

            <div class="ground-rules">
                <h3>Ground Rules</h3>
                <ul>
                    <li>Follow the house rules</li>
                    <li>Treat your Host's home like your own</li>
                </ul>
            </div>
        </div>

        <div class="summary-section">
            <img src="<?php echo $room['image_url']; ?>" alt="Hotel Room">
            <h3><?php echo htmlspecialchars($booking['room_name']); ?></h3>
            <p><?php echo htmlspecialchars($room['description']); ?></p>

            <div class="trip-summary">
                <h3>Your Trip Summary</h3>
                <p><strong>Check-in:</strong> <?php echo htmlspecialchars($booking['arrival_date']); ?></p>
                <p><strong>Check-out:</strong> <?php echo htmlspecialchars($booking['departure_date']); ?></p>
                <p><strong>Guests:</strong> <?php echo htmlspecialchars($booking['guests']); ?></p>
            </div>

            <div class="pricing-breakdown">
                <h3>Pricing Breakdown</h3>
                <p><?php echo $room['price']; ?> Per Night <span><?php echo $room['price']; ?> </span></p>
                <p>Nights: <span><?php echo number_format($number_of_nights); ?></span></p>
                
                <hr>
                <p><strong>Total: </strong> <span>Rs <?php echo number_format($total_price, 2); ?></span></p>
            </div>

            <div class="payment-container">
                <form id="paymentForm">
                    <button type="button" class="confirm-pay" onclick="confirmPayment()">Confirm & Pay</button>
                    <p id="successMessage" class="success-message">✅ Your Room booking is successful!</p>
                </form>
            </div>
        </div>
    </div>

    <script>

document.addEventListener("DOMContentLoaded", function () {
    const cards = document.querySelectorAll(".payment-options .card");

    cards.forEach(card => {
        card.addEventListener("click", () => {
            // Remove selected class from all cards
            cards.forEach(c => c.classList.remove("selected"));
            // Add selected class to clicked card
            card.classList.add("selected");
        });
    });
});

function confirmPayment() {
        const message = document.getElementById("successMessage");
        message.style.display = "block";
        setTimeout(() => {
            message.style.opacity = "1";
        }, 100);
        setTimeout(() => {
            window.location.href = "home.php";
        }, 5000);
    }

    </script>

</body>
</html>