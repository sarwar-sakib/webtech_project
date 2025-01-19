<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mailbox</title>
</head>
<body>
    <h1>Mailbox</h1>
    <a href="sendMail.php">
        <button>Send Mail</button>
    </a>
    <a href="viewMail.php">
        <button>View Mail</button>
    </a>
    <a href="home.php">
        <button>Back</button>
    </a>
</body>
</html>
