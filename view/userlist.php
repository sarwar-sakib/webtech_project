<?php
    session_start();
    require_once('../model/userModel.php');
    if(!isset($_SESSION['status'])){
        header('location: login.html');  
    }
    elseif($_SESSION['user']['account_type'] != 'admin'){
        header('location: home.php');
    }

    $users = getAllUser();
?>

<html lang="en">
<head>
    <title>Userlist </title>

</head>
<body id="userlist-body">
        <h2 id="userlist-heading">User List</h2>    
        <a id="back-link" href="home.php"> Back </a> | 
        <a id="logout-link" href="../controller/logout.php"> logout </a>

        <br>

        <table id="userlist-table" border="1">
            <tr id="table-header">
                <th id="header-id">ID</th>
                <th id="header-username">Username</th>
                <th id="header-email">Email</th>
                <th id="header-account-type">Account Type</th>
                <th id="header-action">Action</th>
            </tr>
            <?php 
                for($i=0; $i<count($users); $i++){ 
                    $userId = $users[$i]['id'];
            ?>
            <tr id="user-row-<?= $userId ?>">
                <td id="user-id-<?= $userId ?>"><?= $userId ?></td>
                <td id="user-username-<?= $userId ?>"><?= $users[$i]['username'] ?></td>
                <td id="user-email-<?= $userId ?>"><?= $users[$i]['email'] ?></td>
                <td id="user-account-type-<?= $userId ?>"><?= $users[$i]['account_type'] ?></td>
                <td id="user-actions-<?= $userId ?>">
                    <a href="edit.php?id=<?= $userId ?>" id="edit-link-<?= $userId ?>"> EDIT </a> |
                    <a href="delete.php?id=<?= $userId ?>" id="delete-link-<?= $userId ?>"> DELETE </a> 
                    <?php $_SESSION['requested_from'] = basename($_SERVER['PHP_SELF']); ?>
                </td>  
            </tr>

            <?php } ?>
            <a href="addUser.php" id="add-user-link"> Add </a> 
        </table>
</body>
</html>
