<?php
session_start();
require_once('../model/transactionModel.php');

if (isset($_REQUEST['submit'])) {

    $delete_id = $_SESSION['transaction_delete_id'];

    $status = deleteTransaction($delete_id);

    if ($status) {
        echo "success"; 
        unset($_SESSION['transaction_delete_id']);  
        exit();
    } else {
        echo "error"; 
    }
} else {
    echo "submit error";
}
?>
