<?php

require_once '../model/userModel.php';

function sendMail($senderId, $receiverId, $message)
{
    $con = getConnection();
    $sql = "INSERT INTO mails (sender_id, receiver_id, message) VALUES ('$senderId', '$receiverId', '$message')";
    return mysqli_query($con, $sql);
}

function getMails($userId)
{
    $con = getConnection();
    $sql = "SELECT * FROM mails WHERE receiver_id='$userId'";
    $result = mysqli_query($con, $sql);

    $mails = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($mails, $row);
    }
    return $mails;
}

?>
