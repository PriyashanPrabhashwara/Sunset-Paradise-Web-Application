<!-- sidebar.php -->
<div class="sidebar">
        <h4 class="text-center">Admin Panel</h4>
        <a href="adminmenu.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="manage_customer.php"><i class="fas fa-book"></i> Manage Users</a>
        <a href="manage_staff.php"><i class="fas fa-hotel"></i> Manage staff</a>
        <a href="view_query.php"><i class="fas fa-comments"></i> View Queries</a>
        <a href="Manage_rooms.php"><i class="fas fa-hotel"></i> Manage Rooms</a>
        <a href="Manage_food.php"><i class="fas fa-hotel"></i> Manage Food Items</a>
        <a href="Manage_Activities.php"><i class="fas fa-hotel"></i> Manage Activities</a>
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
