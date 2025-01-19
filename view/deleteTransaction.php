<?php
session_start();
require_once('../model/transactionModel.php');

if (!isset($_SESSION['status'])) {
    header('location: login.html');
} elseif ($_SESSION['user']['account_type'] != 'admin') {
    header('location: home.php');
}

$transaction = getTransaction($_REQUEST['id']);
$_SESSION['transaction_delete_id'] = $_REQUEST['id'];
?>

<html>
<head>
    <title>DELETE Transaction</title>
</head>
<body align="center">
    <fieldset>
        <legend>Delete Transaction</legend>
        <h2>Delete Transaction</h2>
        <form id="deleteTransactionForm" onsubmit="return false;"> 
            <table border="1" cellspacing="0" align="center">
                <tr>
                    <td align="left"><b>Transaction ID</b></td>
                    <td align="left"><b>Date</b></td>
                    <td align="left"><b>From</b></td>
                    <td align="left"><b>To</b></td>
                    <td align="left"><b>Amount</b></td>
                    <td align="left"><b>Status</b></td>
                </tr>
                <tr>
                    <td><?=$transaction["transaction_id"]?></td>
                    <td><?=$transaction["transaction_date"]?></td>
                    <td><?=$transaction["transaction_from"]?></td>
                    <td><?=$transaction["transaction_to"]?></td>
                    <td><?=$transaction["transaction_amount"]?></td>
                    <td><?=$transaction["transaction_status"]?></td>
                </tr>
            </table>
            <hr>
            <input type="button" value="Confirm Deletion" onclick="ajaxDelete()" /> 
        </form>
        <br>
        <a href="transactionList.php">Cancel</a>
    </fieldset>
    <script src="../asset/confirmDeleteTransaction.js"></script> 
</body>
</html>
