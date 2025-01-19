<?php 
    session_start();
    require_once('../model/userModel.php');

    if (isset($_REQUEST['submit'])) {
        $username = trim($_REQUEST['username']);
        $password = trim($_REQUEST['password']);
        $email = trim($_REQUEST['email']);
        $account_type = trim($_REQUEST['account_type']);

        if (empty($username) || empty($password) || empty($email) || empty($account_type)) {
            echo "Null username/password/email/account_type";
        } 

        elseif (strlen($username) < 4 || !ctype_alpha($username[0]) || strpos($username, ' ') !== false) {
            echo "Username must be at least 4 characters, start with a letter, and contain no spaces.";
        } 

        elseif (strlen($password) < 4) {
            echo "Password length must be at least 4 characters.";
        } 

        elseif (strpos($email, '@') === false || strpos($email, '.') === false || strpos($email, '@') > strrpos($email, '.')) {
            echo "Enter a valid email address.";
        } 

        else {
            $status = updateUser($_SESSION['update_id'], $username, $email, $password, $account_type);
            if ($status) {
                $_SESSION['user'] = getUser($_SESSION['user']['id']);
                if($_SESSION['requested_from']=="home.php"){
                    echo '<script>window.location.href = "../view/home.php";</script>';
                }
                else{
                    echo '<script>window.location.href = "../view/userlist.php";</script>';
                }
                unset($_SESSION['update_id']);
            } else {
                echo "An error occurred";
                ?>
                <a href="../view/userlist.php">Return to Userlist</a>
                <?php
            }
        }
    } else {
        echo '<script>window.location.href = "../view/signup.html";</script>';
    }
?>
