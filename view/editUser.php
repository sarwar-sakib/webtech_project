<?php
    session_start();
    require_once('../model/userModel.php');
    // if(!isset($_COOKIE['status'])){
    //     header('location: login.html');  
    // }
    if(!isset($_SESSION['status'])){
        header('location: login.html');  
    }
    // elseif($_SESSION['user']['account_type'] != 'admin'){
    //     header('location: home.php');
    // }
    // if(isset($_REQUEST['id'])){
    //     echo $_REQUEST['id'];
    // }
    $user = getUser($_REQUEST['id']);
    $_SESSION['update_id'] = $_REQUEST['id'];
?>

<html>
<head>
    <title>Edit Page</title>
</head>
<body align="center">
    <fieldset>
        <legend>Edit User</legend>
        <h2>Edit User</h2>
        <form method="post" action="../controller/updateUser.php">
            <table align="center">
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="username" value="<?=$user['username']?>" /></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" value="<?=$user['email']?>" /></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" value="<?=$user['password']?>" /></td>
                </tr>
                <tr>
                    <td>Account Type:</td>
                    <td>
                        <?php if($_SESSION['user']['account_type'] == 'admin'){ ?>
                            <select name="account_type">
                                <option value=""></option>
                                <option value="admin">Admin</option>
                                <option value="webmaster">Webmaster</option>
                                <option value="advertiser">Advertiser</option>
                            </select>
                        <?php } else { ?>
                            <select name="account_type">
                                <option value="<?=$user['account_type']?>"><?=$user['account_type']?></option>
                            </select>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <br>
                        <b>
                            Update will take affect after relogging in.
                        </b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="submit" value="Submit" />
                    </td>
                </tr>
            </table>
        </form>
        <?php if($_SESSION['requested_from'] == 'home.php'){ ?>
            <a href="home.php">Cancel</a> 
        <?php } else { ?>
            <a href="userlist.php">Cancel</a> 
        <?php } ?>
    </fieldset>
</body>
</html>
