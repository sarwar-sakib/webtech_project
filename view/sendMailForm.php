<?php
session_start();
require_once('../model/userModel.php');

if (!isset($_SESSION['status'])) {
    header('location: login.html');
    exit();
}

$receiverId = $_GET['id'];
$receiver = getUser($receiverId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Send Mail</title>
</head>
<body>
    <h1>Send Mail to <?= $receiver['username'] ?></h1>
    <form method="post" action="../controller/sendMailHandler.php">
        <input type="hidden" name="receiver_id" value="<?= $receiverId ?>">
        <textarea name="message" rows="5" cols="40" placeholder="Enter your message here..." required></textarea>
        <br><br>
        <input type="submit" name="submit" value="Send">
    </form>
    <br>
    <a href="sendMail.php">Back</a>
</body>
</html>
