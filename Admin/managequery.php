<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: adminlog.php");
    exit;
}
    include 'dbc.php';

    $sql3 = "SELECT * FROM queries ORDER BY id ASC";
    $result3 = $conn->query($sql3);
?>


<html>
    <head>
    <title>Dashboard</title>
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

<div class="manage-queries">
    <h1>Manage Queries</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>User ID</th>
                <th>Query</th>
                <th>Response</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result3->num_rows > 0): ?>
                <?php foreach ($result3 as $row): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['User_ID']; ?></td>
                        <td><?php echo $row['Message']; ?></td>
                        <td><?php echo $row['Response'] ? $row['Response'] : 'No response yet'; ?></td>
                        <td>
                            <a href="respond-query.php?id=<?php echo $row['id']; ?>">Respond</a> |
                            <a href="delete-query.php?id=<?php echo $row['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No queries found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>
</body>
</html>