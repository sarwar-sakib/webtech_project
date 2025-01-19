<?php
session_start();

if (!isset($_SESSION['status'])) {
    header('location: ../view/login.html');
    exit();
}

// Redirect to the request payout form.
header('Location: ../view/requestPayoutForm.php');
exit();
?>
