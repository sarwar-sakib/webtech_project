<?php
session_start();
require_once('../model/payoutModel.php');

if (isset($_POST['request_payout'])) {
    header('Location: ../view/requestPayoutForm.php');
    exit();
}
?>
