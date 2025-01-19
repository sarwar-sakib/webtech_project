<?php

session_start();

if (!isset($_SESSION['status']) || $_SESSION['user']['account_type'] != 'admin') {
    echo json_encode([
        'status' => 'error',
        'message' => 'Unauthorized access. Please log in as admin.'
    ]);
    exit();
}

require_once('../model/payoutModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payout_id'])) {
    $payout_id = $_POST['payout_id'];

    if (approvePayout($payout_id)) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Payout approved successfully.',
            'payout_id' => $payout_id
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to approve the payout.'
        ]);
    }
    exit();
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request.'
    ]);
    exit();
}
?>
