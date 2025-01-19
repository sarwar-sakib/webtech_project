<?php 
session_start();
require_once('../model/userModel.php');

if (isset($_REQUEST['submit'])) { 
    $username = trim($_REQUEST['username']);
    $password = trim($_REQUEST['password']);

    if ($username == null || empty($password)) {
        echo "Null username/password";
    } else {
        $status = login($username, $password);
        if ($status) {
            setcookie('status', 'true', time() + 3600, '/');
            $_SESSION['status'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['user'] = getUserInfo($username);

            // Check account type for advertiser notifications
            $user = $_SESSION['user'];
            if ($user['account_type'] == 'advertiser') {
                $con = getConnection();
                $checkNotification = "SELECT * FROM notifications WHERE username = '{$username}'";
                $result = mysqli_query($con, $checkNotification);

                // Add a notification only if none exists
                if (mysqli_num_rows($result) == 0) {
                    $notificationMessage = "Welcome to our system! Start by exploring the available newspapers.";
                    $insertNotification = "INSERT INTO notifications (username, message) VALUES ('{$username}', '{$notificationMessage}')";
                    mysqli_query($con, $insertNotification);
                }
            }

            echo "success";
        } else {
            echo "invalid";
        }
    }
} else {
    echo "Invalid request";
}
?>
