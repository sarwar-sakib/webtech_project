<?php 
session_start();
require_once('../model/ticketModel.php');

if (isset($_REQUEST['submit'])) {
    $ticket_id = $_SESSION['ticket_delete_id'];

    $status = deleteTicket($ticket_id);

    if ($status) {
        echo "success"; 
        unset($_SESSION['ticket_delete_id']);  
    } else {
        echo "error"; 
    }
} else {
    echo "submit error";
}
?>
