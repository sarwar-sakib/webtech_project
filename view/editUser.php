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
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            text-align: center;
        }
        fieldset {
            margin: 30px auto;
            border: 1px solid #007bff;
            width: 90%;
            max-width: 600px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        legend {
            font-size: 22px;
            color: #007bff;
            padding: 0 10px;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        td {
            padding: 10px;
            font-size: 14px;
            text-align: left;
        }
        input[type="text"], input[type="email"], input[type="password"], select {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            display: inline-block;
            margin-top: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
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
                        <?php if ($_SESSION['user']['account_type'] == 'admin') { ?>
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
                        <br><input type="submit" name="submit" value="Submit" />
                    </td>
                </tr>
            </table>
        </form>
        <?php if ($_SESSION['requested_from'] == 'home.php') { ?>
            <a href="home.php">Cancel</a> 
        <?php } else { ?>
            <a href="userlist.php">Cancel</a> 
        <?php } ?>
    </fieldset>
</body>
</html>
