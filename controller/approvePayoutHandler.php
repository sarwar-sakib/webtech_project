<?php
session_start();
require_once('../model/payoutModel.php');

if (!isset($_SESSION['status']) || $_SESSION['user']['account_type'] !== 'admin') {
    header('location: ../view/login.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payout_id = $_POST['payout_id'] ?? null;

    if ($payout_id && approvePayout($payout_id)) {
        header('location: ../view/payoutHistory.php?success=1');
        exit();
    } else {
        header('location: ../view/payoutHistory.php?error=1');
        exit();
    }
}
?>
