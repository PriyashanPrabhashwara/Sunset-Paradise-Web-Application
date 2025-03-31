<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
</head>
<body>
<?php include 'sidebar.php'; ?>
    <div class="main-content">
        <h2>Dashboard</h2>
        <div class="row dashboard-cards">
            <div class="col-md-3">
                <div class="card p-3 text-center bg-primary text-white">
                    <h5>Total Bookings</h5>
                    <h3>1,245</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 text-center bg-warning text-white">
                    <h5>Pending Queries</h5>
                    <h3>56</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 text-center bg-danger text-white">
                    <h5>Canceled Bookings</h5>
                    <h3>23</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 text-center bg-success text-white">
                    <h5>Orders Processed</h5>
                    <h3>789</h3>
                </div>
            </div>
        </div>

</body>
</html>
