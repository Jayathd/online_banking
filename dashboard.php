<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

$username = $_SESSION['user'];
$sql = "SELECT * FROM transactions WHERE username='$username'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Welcome, <?php echo $username; ?></h2>
    <a href="transactions.php">View Transactions</a>
    <a href="logout.php">Logout</a>
</body>
</html>
