<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: adminlog.php");
    exit;
}
include 'dbc.php';

$users = $conn->query("SELECT * FROM form");
?>

<html>
    <head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="admin.css?v=<?php echo time(); ?>">
    </head>
<body>

         <!-- Navbar -->
<header class="header">
<a href="adminmenu.php"><img src="logo.png" width="60px" style="border-radius: 10px;"> </a>
    <nav>
        <ul>
            <li><a href="usermanage.php">Manage Users</a></li>
            <li><a href="manageclass.php">Manage Classes</a></li>
            <li><a href="manageblog.php">Manage Blogs</a></li>
            <li><a href="managequery.php">Manage Queries</a></li>
            <li><a href="staffaccounts.php">Create Accounts</a></li>
            <li><a href="Add-Products.php">Add Products</a></li>
        </ul>
    </nav>
<a class="btn1" href="adminlog.php">Sign-in</a>
<a class="btn1" href="adminlogout.php">Sign-out</a>
</header>

<div class="manage-users">
        <h1>Manage Users</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Password</th>
                <th>Gender</th>
                <th>Plan</th>
                <th>Action</th>
            </tr>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['CustomerName']; ?></td>
                <td><?php echo $user['Email']; ?></td>
                <td><?php echo $user['Number']; ?></td>
                <td><?php echo $user['Password']; ?></td>
                <td><?php echo $user['Gender']; ?></td>
                <td><?php echo $user['Plan']; ?></td>
                <td>
                    <a href="edit-user.php?id=<?php echo $user['id']; ?>">Edit</a> |
                    <a href="delete-user.php?id=<?php echo $user['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>