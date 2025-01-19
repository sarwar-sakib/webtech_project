<?php
    session_start();
    require_once('../model/transactionModel.php');
    // if(!isset($_COOKIE['status'])){
    //     header('location: login.html');  
    // }
    if(!isset($_SESSION['status'])){
        header('location: login.html');  
    }
    if (trim($_SESSION['user']['account_type']) == 'admin'){
        $transactions = getAllTransaction();
    }
    else
    {
        $transactions = getUserTransaction($_SESSION['user']['id']);
    }
    // print_r($transactions);
?>

<html lang="en">
<head>
    <title>Transaction List for <?=$_SESSION['user']['account_type'] ?></title>
</head>
<body align="center">
    <fieldset>
        <legend>Transaction List</legend>
        <h2>Transaction List</h2>    
        <br>
        <table border="1" cellspacing="0" align="center">
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>From</th>
                <th>To</th>
                <th>Amount</th>
                <th>Status</th>
                <?php if($_SESSION['user']['account_type'] == "admin") { ?>
                <th>Action</th>
                <?php } ?>
            </tr>
            <?php 
                for($i = 0; $i < count($transactions); $i++) { 
            ?>
            <tr align="center">
                <td><?php echo $transactions[$i]['transaction_id']; ?></td>
                <td><?=$transactions[$i]['transaction_date'] ?></td>
                <td><?=$transactions[$i]['transaction_from'] ?></td>
                <td><?=$transactions[$i]['transaction_to'] ?></td>
                <td><?=$transactions[$i]['transaction_amount'] ?></td>
                <td><?=$transactions[$i]['transaction_status'] ?></td>
                <?php if($_SESSION['user']['account_type'] == "admin") { ?>
                <td>
                    <a href="deleteTransaction.php?id=<?=$transactions[$i]['transaction_id']?>"> DELETE </a>
                    <?php $_SESSION['requested_from'] = basename($_SERVER['PHP_SELF']); ?>
                </td>  
                <?php } ?>
            </tr>
            <?php } ?>
        </table>
        <br>
        <a href="home.php"> Back </a> | 
        <a href="../controller/logout.php"> logout </a>
    </fieldset>
</body>
</html>
