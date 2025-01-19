<?php
require_once '../model/userModel.php';

function getAllPayouts() {
    $con = getConnection();
    $sql = "SELECT p.id, u.username, p.amount, p.status
            FROM payouts p
            JOIN users u ON p.user_id = u.id";
    $result = mysqli_query($con, $sql);

    $payouts = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $payouts[] = $row;
    }
    return $payouts;
}


//specific user
function getPayoutHistoryByUser($user_id) {
    $con = getConnection();
    $sql = "SELECT p.id, p.amount, p.status, u.username
            FROM payouts p
            JOIN users u ON p.user_id = u.id
            WHERE p.user_id = '$user_id'";  
    $result = mysqli_query($con, $sql);

    $payouts = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $payouts[] = $row;
    }
    return $payouts;
}

function approvePayout($payout_id) {
    $con = getConnection();
    $sql = "UPDATE payouts SET status = 'completed' WHERE id = $payout_id";
    if(mysqli_query($con, $sql))
        return true;
    else
        return false;
}

function requestPayout($user_id, $amount) {
    $con = getConnection();
    $sql = "INSERT INTO payouts (user_id, amount, status) VALUES ('$user_id', '$amount', 'pending')";
    return mysqli_query($con, $sql);
}


?>
