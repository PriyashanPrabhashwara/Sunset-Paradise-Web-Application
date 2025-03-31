<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include 'dbc.php'; // Database connection

// Fetch upcoming bookings (only Active ones)
$query = "SELECT * FROM bookings WHERE arrival_date >= CURDATE() AND status = 'Active' ORDER BY arrival_date";
$result = $conn->query($query);

// Handle booking cancellation
if (isset($_POST['cancel_booking'])) {
    $booking_id = intval($_POST['booking_id']);
    
    // Update booking status to 'Cancelled'
    $update_query = "UPDATE bookings SET status='Cancelled' WHERE id=?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("i", $booking_id);

    if ($stmt->execute()) {
        // Fetch user email from customers table
        $email_query = "SELECT customers.Email FROM customers 
                        INNER JOIN bookings ON customers.User_ID  = bookings.User_ID 
                        WHERE bookings.id = ?";
        $stmt_email = $conn->prepare($email_query);
        $stmt_email->bind_param("i", $booking_id);
        $stmt_email->execute();
        $result_email = $stmt_email->get_result();
        $user = $result_email->fetch_assoc();
        $user_email = $user['Email'];

        // Send cancellation email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug=0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Use SMTP host (Gmail, Outlook, etc.)
            $mail->SMTPAuth = true;
            $mail->Username = 'smjayanidesilva@gmail.com'; 
            $mail->Password = 'gbnk rjln ziif vuvm'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('smjayanidesilva@gmail.com', 'Sunset Paradise');
            $mail->addAddress($user_email);
            $mail->isHTML(true);
            $mail->Subject = "Booking Cancelled Confirmation";
            $mail->Body = "<h3>Dear Customer,</h3>
                           <p>Your booking has been cancelled.</p>
                           <p>If you not aware of this, please contact us.</p>
                           <br>
                           <p>Regards,<br>Sunset Paradise</p>";
            $mail->send();
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        header("Location: manage_booking.php?canceled=success");
        exit();
    } else {
        echo "Error canceling booking: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .container {margin-left: 240px; padding: 20px;}
        .table { box-shadow: 0px 0px 10px rgba(0,0,0,0.1); width: 97%;}
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>

<div class="container">
    <h2 class="mb-4">Manage Bookings</h2>

    <?php if (isset($_GET['canceled']) && $_GET['canceled'] == "success"): ?>
        <div class="alert alert-success">Booking has been successfully canceled.</div>
    <?php endif; ?>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Booking ID</th>
                <th>Room Name</th>
                <th>Guest Name</th>
                <th>Arrival Date</th>
                <th>Departure Date</th>
                <th>Guests</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['room_name']) ?></td>
                <td><?= htmlspecialchars($row['User_ID']) ?></td>
                <td><?= $row['arrival_date'] ?></td>
                <td><?= $row['departure_date'] ?></td>
                <td><?= $row['guests'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="booking_id" value="<?= $row['id'] ?>">
                        <button type="submit" name="cancel_booking" class="btn btn-danger btn-sm">Cancel</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
