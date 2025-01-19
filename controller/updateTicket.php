<?php
session_start();
require_once('../model/ticketModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_REQUEST['submit'])) {
        $ticket_solution = $_REQUEST['ticket_solution'];
        if (empty($ticket_solution)) {
            echo "Null Entry";
        }

        elseif (strpos($ticket_solution, "'") !== false || strpos($ticket_solution, '"') !== false) {
            echo "Entries cannot contain single quotes (') or double quotes (\")";
        } else {
            $status = updateTicket($_SESSION['ticket_responded_id'], "Responded", $ticket_solution);
            if ($status) {
                echo "success"; 
                unset($_SESSION['ticket_responded_id']);
            } else {
                echo "An error occurred while responding to the ticket.";
            }
        }
    } else {
        header('location: ../view/login.html');
    }
}
else
{
    echo "Invalid request.";
}
?>
