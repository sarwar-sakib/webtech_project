<?php
session_start();
require_once('../model/mailModel.php');

if (!isset($_SESSION['status'])) {
    header('location: login.html');
    exit();
}

$mails = getMails($_SESSION['user']['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>View Mail</title>
</head>
<body>
<link rel="stylesheet" href="../asset/payoutHistory.css">
    <h1>Received Mails</h1>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Sender ID</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mails as $mail) { ?>
                <tr>
                    <td><?= $mail['sender_id'] ?></td>
                    <td><?= $mail['message'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <a href="mailbox.php">Back</a>
</body>
</html>
