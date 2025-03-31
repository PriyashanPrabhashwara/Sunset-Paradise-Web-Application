<?php
include 'dbc.php';

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM queries WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: adminmenu.php?message=Query Deleted successfully");
exit();
?>