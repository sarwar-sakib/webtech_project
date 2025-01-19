<?php
session_start();
header('Content-Type: text/html'); 

if (!isset($_SESSION['status'])) {
    echo "<p style='color: red;'>Unauthorized access. Please log in.</p>";
    exit();
}

require_once('../model/payoutModel.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = intval($_POST['amount'] ?? 0);
    $userId = $_SESSION['user']['id'] ?? null;

    if ($amount >= 100 && $userId) { 
        if (requestPayout($userId, $amount)) {
            echo "<script>
                    window.onload = function() {
                        alert('Success');
                        window.location.href = 'payout.php'; // Redirect to payout.php after alert
                    }
                  </script>";
            exit();
        } else {
            echo "<p style='color: red;'>Failed to submit payout request. Please try again.</p>";
        }
    } else {
        echo "<p style='color: red;'>Invalid amount. Please enter a value greater than or equal to 100.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Payout</title>
</head>
<body>
    <h2>Request Payout</h2>
    <form method="POST" action="">
        <label for="amount">Enter Amount:</label>
        <input type="number" id="amount" name="amount" min="100" required>
        <button type="submit">Submit</button>
    </form>
    <br>
    <a href="payout.php">Back</a>
</body>
</html>
