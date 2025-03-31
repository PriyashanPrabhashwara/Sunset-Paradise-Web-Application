<!-- sidebar.php -->
<div class="sidebar">
        <h4 class="text-center">Staff Panel</h4>
        <a href="staffmenu.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="view_customer.php"><i class="fas fa-book"></i> View Users</a>
        <a href="manage_booking.php"><i class="fas fa-book"></i> Manage Bookings</a>
        <a href="staff_orders.php"><i class="fas fa-utensils"></i> Process Orders</a>
        <a href="manage_query.php"><i class="fas fa-comments"></i> Respond to Queries</a>
        <a href="Manage_rooms.php"><i class="fas fa-hotel"></i> Manage Rooms</a>
        <a href="Manage_food.php"><i class="fas fa-hotel"></i> Manage Food Items</a>
        <a href="Transport.php"><i class="fas fa-hotel"></i> Manage Transport</a>
        <a href="#"><i class="fas fa-cog"></i> Logout</a>
    </div>

<style>
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f7fc;
}
.sidebar {
    width: 230px;
    height: 100vh;
    position: fixed;
    background: #1a1f36;
    color: #fff;
    padding-top: 20px;
    transition: all 0.3s;
}
.sidebar a {
    color: #b0b8c5;
    text-decoration: none;
    padding: 15px 20px;
    display: block;
    transition: 0.3s;
}
.sidebar a:hover {
    background: #252b48;
    color: #fff;
}
.main-content {
    margin-left: 250px;
    padding: 20px;
}
.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.dashboard-cards .card {
    transition: transform 0.2s;
}
.dashboard-cards .card:hover {
    transform: translateY(-5px);
}
</style>
