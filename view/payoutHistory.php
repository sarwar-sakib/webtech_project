<?php
session_start();
require_once('../model/payoutModel.php');
if (!isset($_SESSION['status'])) {
    header('location: login.html');
    exit();
}

$user_id = $_SESSION['user']['id'];
$account_type = $_SESSION['user']['account_type'];

if ($account_type == 'admin') {
    $payouts = getAllPayouts();
} else {
    $payouts = getPayoutHistoryByUser($user_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payout History</title>
</head>
<body>
    <h1>Payout History</h1>

    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Amount</th>
            <th>Status</th>
            <?php if ($account_type == 'admin') { ?>
                <th>Action</th>
            <?php } ?>
        </tr>
        <?php foreach ($payouts as $payout) { ?>
            <tr>
                <td><?= $payout['id'] ?></td>
                <td><?= $payout['username'] ?></td>
                <td><?= $payout['amount'] ?></td>
                <td><?= $payout['status'] ?></td>
                <?php if ($account_type == 'admin' && $payout['status'] == 'pending') { ?>
                    <td>
                        <form method="post" action="../controller/approvePayoutHandler.php">
                            <input type="hidden" name="payout_id" value="<?= $payout['id'] ?>">
                            <button type="submit">Approve</button>
                        </form>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>

    <br>
    <a href="home.php">Back to Home</a>
</body>
</html>
