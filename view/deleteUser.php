<?php
    session_start();
    require_once('../model/userModel.php');
    // if(!isset($_COOKIE['status'])){
    //     header('location: login.html');  
    // }
    if(!isset($_SESSION['status'])){
        header('location: login.html');  
    }
    elseif($_SESSION['user']['account_type'] != 'admin'){
        header('location: home.php');
    }
    // if(isset($_REQUEST['id'])){
    //     echo $_REQUEST['id'];
    // }

    $user = getUser($_REQUEST['id']);
    $_SESSION['delete_id'] = $_REQUEST['id'];
?>

<html>
<head>
    <title>DELETE USER</title>
</head>
<body align="center">
    <fieldset>
        <legend>Delete User</legend>
        <h2>Delete User</h2>
        <form method="post" action="../controller/confirmDeleteUser.php">
            <table border=1 cellspacing=0 align="center">
                <tr>
                    <td><b>Username:</b></td>
                    <td><?=$user["username"]?></td>
                </tr>
                <tr>
                    <td><b>Password:</b></td>
                    <td><?=$user["password"]?></td>
                </tr>
                <tr>
                    <td><b>Email:</b></td>
                    <td><?=$user["email"]?></td>
                </tr>
                <tr>
                    <td><b>Account Type:</b></td>
                    <td><?=$user["account_type"]?></td>
                </tr>
            </table>
            <hr>
            <div align="center">
                <input type="submit" name="submit" value="Confirm Deletion" />
            </div>
        </form>
        <br>
        <a href="userlist.php">Cancel</a>
    </fieldset>
</body>
</html>
