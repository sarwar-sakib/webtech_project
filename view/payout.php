<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location: login.html');
    exit();
}
require_once('../model/payoutModel.php');
?>

<html>
<head>
    <title>User Payout</title>
</head>
<body>
    <h2>Payout Options</h2>
    <form action="../controller/requestPayoutHandler.php" method="post">
        <button type="submit" name="request_payout">Request Payout</button>
    </form>
    <form action="payoutHistory.php" method="get">
        <button type="submit">Payout History</button>
    </form>
</body>
</html>
