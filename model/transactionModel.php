<?php

    function getConnection(){
        $con = mysqli_connect('127.0.0.1', 'root', '', 'testing_project');
        return $con;
    }

    function transactionExists($transaction_id){
        $con = getConnection();
        $sql = "select * from transactions where transaction_id='{$transaction_id}'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);

        if($count==0){
            return false;
        }else{
            return true;
        }
    }

    function addTransaction($transaction_date, $transaction_from, $transaction_to, $transaction_amount, $transaction_status){
        $con = getConnection();
        $sql = "insert into transactions VALUES('', '{$transaction_date}', '{$transaction_from}', '{$transaction_to}', '{$transaction_amount}', '{$transaction_status}')";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function deleteTransaction($transaction_id){
        $con = getConnection();
        $sql = "DELETE FROM transactions where transaction_id=$transaction_id";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function getTransaction($transaction_id){
        $con = getConnection();
        $sql = "select * from transactions where transaction_id=$transaction_id";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    function getUserTransaction($id){
        $con = getConnection();
        $sql = "select * from transactions where transaction_from=$id or transaction_to=$id";
        $result = mysqli_query($con, $sql);

        $transactions = [];

        while($row = mysqli_fetch_assoc($result)){
            //print_r($row);
            //echo "<br>";
            array_push($transactions, $row);
        }
        
        return $transactions;
    }

    function getAllTransaction(){
        $con = getConnection();
        $sql = "select * from transactions";
        $result = mysqli_query($con, $sql);

        $users = [];

        while($row = mysqli_fetch_assoc($result)){
            //print_r($row);
            //echo "<br>";
            array_push($users, $row);
        }
        
        return $users;
    }

?>