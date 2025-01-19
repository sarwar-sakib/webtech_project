<?php 
    session_start();
    require_once('../model/ticketModel.php');

    if (isset($_REQUEST['submit'])) {
        $ticket_from = $_SESSION['user']['id'];
        $ticket_desc = trim($_REQUEST['ticket_desc']);

        if (empty($ticket_from) || empty($ticket_desc)) {
            echo "Null Entries";
        }
        elseif (strpos($ticket_from, "'") !== false || strpos($ticket_from, '"') !== false ||
                strpos($ticket_desc, "'") !== false || strpos($ticket_desc, '"') !== false) {
            echo "Entries cannot contain single quotes (') or double quotes (\")";
        } 
        elseif (strlen($ticket_desc) < 5) {
            echo "Ticket description must be at least 5 characters long.";
        } 
        else {
            $status = addTicket($ticket_from, $ticket_desc);
            if ($status) {
                echo "success";
            } else {
                echo "An error occurred";
            }
        }
    } else {
        header('location: ../view/login.html');
    }
?>
