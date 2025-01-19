<?php 
    session_start();
    require_once('../model/userModel.php');
    if(isset($_REQUEST['submit'])){
        $password = trim($_REQUEST['password']);
        $confirm_pass = trim($_REQUEST['confirm_password']);

        if($password == null || empty($confirm_pass)){
            echo "Null entires.";
        }
        elseif($password != $confirm_pass){
            echo "Password doesn't match";
        }
        elseif(strlen($password) < 4){
            echo "Password must be atleast 4 characters";
        }
        else{
            $status = updatePassword($_SESSION['user']['id'], $password);
            if($status){
                echo "<pPassword updated";
?>
                <br>
                <a href="../view/login.html"> Return to Login </a>
<?php
            } else{
                echo "an error occured";
?>
                <a href="../view/forgot_password.php"> Return to Userlist </a>
<?php
                
            }
        }

    }else{
        header('location: ../view/forgot_password.html');
    }

?>