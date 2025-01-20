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
            padding: 20px;
        }
        fieldset {
            margin: 30px auto;
            border: 1px solid #007bff;
            width: 90%;
            max-width: 900px;
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
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 14px;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .action-links a {
            margin: 0 5px;
        }
        .action-links a:hover {
            color: #dc3545;
        }
    </style>
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
                <td class="action-links">
                    <a href="deleteTransaction.php?id=<?=$transactions[$i]['transaction_id']?>">DELETE</a>
                    <?php $_SESSION['requested_from'] = basename($_SERVER['PHP_SELF']); ?>
                </td>  
                <?php } ?>
            </tr>
            <?php } ?>
        </table>
        <br>
        <a href="home.php">Back</a> | 
        <a href="../controller/logout.php">Logout</a>
    </fieldset>
</body>
</html>
