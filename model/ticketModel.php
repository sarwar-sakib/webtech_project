<?php

    function getConnection(){
        $con = mysqli_connect('127.0.0.1', 'root', '', 'testing_project');
        return $con;
    }

    function ticketExists($id){
        $con = getConnection();
        $sql = "select * from tickets where ticket_id='{$id}'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);

        if($count==0){
            return false;
        }else{
            return true;
        }
    }

    function addticket($ticket_from, $ticket_desc){
        $con = getConnection();
        $sql = "insert into tickets VALUES('', '{$ticket_from}', '$ticket_desc', 'Unresolved', '')";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function updateTicket($id, $ticket_status, $ticket_solution){
        $con = getConnection();
        $sql = "update tickets SET ticket_status='$ticket_status', ticket_solution='$ticket_solution' where ticket_id='$id'";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function deleteTicket($id){
        $con = getConnection();
        $sql = "DELETE FROM tickets where ticket_id=$id";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function getTicket($id){
        $con = getConnection();
        $sql = "select * from tickets where ticket_id='{$id}'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    function getUserTicket($id){
        $con = getConnection();
        $sql = "select * from tickets where ticket_from='{$id}'";
        $result = mysqli_query($con, $sql);
        $tickets = [];

        while($row = mysqli_fetch_assoc($result)){
            //print_r($row);
            //echo "<br>";
            array_push($tickets, $row);
        }
        
        return $tickets;
    }

    function getAllTicket(){
        $con = getConnection();
        $sql = "select * from tickets";
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