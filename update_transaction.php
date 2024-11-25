<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

$transactionId = $_GET['id']; // Get the transaction ID from the URL
$sql = "SELECT * FROM transactions WHERE id='$transactionId'";
$result = $conn->query($sql);
$transaction = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $type = $_POST['type'];

    $sql = "UPDATE transactions SET amount='$amount', type='$type' WHERE id='$transactionId'";
    if ($conn->query($sql) === TRUE) {
        header('Location: transactions.php'); // Redirect back to the transactions page
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Transaction</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Update Transaction</h2>
    <form method="POST">
        <label>Amount:</label>
        <input type="number" name="amount" value="<?php echo $transaction['amount']; ?>" required>
        <label>Type:</label>
        <select name="type">
            <option value="credit" <?php if ($transaction['type'] == 'credit') echo 'selected'; ?>>Credit</option>
            <option value="debit" <?php if ($transaction['type'] == 'debit') echo 'selected'; ?>>Debit</option>
        </select>
        <button type="submit">Update</button>
    </form>
</body>
</html>
