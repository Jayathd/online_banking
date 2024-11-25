<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

$username = $_SESSION['user'];

// Handle form submission to add a transaction
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $type = $_POST['type'];

    $sql = "INSERT INTO transactions (username, amount, type) VALUES ('$username', '$amount', '$type')";
    if ($conn->query($sql) === TRUE) {
        $message = "Transaction added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

// Fetch existing transactions for the logged-in user
$sql = "SELECT * FROM transactions WHERE username='$username'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Transactions</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Welcome, <?php echo $username; ?></h2>
    <h3>Add a Transaction</h3>
    <form method="POST">
        <input type="number" name="amount" placeholder="Amount" required>
        <select name="type">
            <option value="credit">Credit</option>
            <option value="debit">Debit</option>
        </select>
        <button type="submit">Add Transaction</button>
    </form>
    <?php if (isset($message)) echo "<p>$message</p>"; ?>

    <h3>Your Transactions</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Amount</th>
            <th>Type</th>
            <th>Date</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['amount']; ?></td>
            <td><?php echo $row['type']; ?></td>
            <td><?php echo $row['date']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
