<?php
session_start();
require_once('../model/userModel.php');
require_once('../model/mailModel.php');

if (!isset($_SESSION['status'])) {
    header('location: login.html');
    exit();
}

if (isset($_POST['submit'])) {
    $senderId = $_SESSION['user']['id'];
    $receiverId = $_POST['receiver_id'];
    $message = $_POST['message'];

    // Send the mail
    if (sendMail($senderId, $receiverId, $message)) {
        // Return success response
        echo json_encode([
            'status' => 'success',
            'message' => 'Mail sent successfully!'
        ]);
    } else {
        // Return error response
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to send mail!'
        ]);
    }
}
?>
