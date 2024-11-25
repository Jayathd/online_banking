<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

$transactionId = $_GET['id']; // Get the transaction ID from the URL

$sql = "DELETE FROM transactions WHERE id='$transactionId'";
if ($conn->query($sql) === TRUE) {
    header('Location: transactions.php'); // Redirect back to the transactions page
} else {
    echo "Error deleting record: " . $conn->error;
}
?>
