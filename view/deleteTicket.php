<?php
session_start();
require_once('../model/ticketModel.php');

if (!isset($_SESSION['status'])) {
    header('location: login.html');
} elseif ($_SESSION['user']['account_type'] != 'admin') {
    header('location: home.php');
}

$ticket = getTicket($_REQUEST['id']);
$_SESSION['ticket_delete_id'] = $_REQUEST['id'];
?>

<html>
<head>
    <title>DELETE Ticket</title>
</head>
<body align="center">
    <fieldset>
        <legend>Delete Ticket</legend>
        <h2>Delete Ticket</h2>
        <form id="deleteTicketForm" onsubmit="return false;"> 
            <table border="1" cellspacing="0" align="center">
                <tr>
                    <td align="left"><b>Ticket ID</b></td>
                    <td align="left"><b>Ticket From</b></td>
                    <td align="left"><b>Ticket Description</b></td>
                    <td align="left"><b>Ticket Status</b></td>
                    <td align="left"><b>Ticket Response</b></td>
                </tr>
                <tr>
                    <td><?=$ticket["ticket_id"]?></td>
                    <td><?=$ticket["ticket_from"]?></td>
                    <td><?=$ticket["ticket_desc"]?></td>
                    <td><?=$ticket["ticket_status"]?></td>
                    <td><?=$ticket["ticket_solution"]?></td>
                </tr>
            </table>
            <hr>
            <input type="button" value="Confirm Deletion" onclick="ajaxDeleteTicket()" />
        </form>
        <br>
        <a href="viewTickets.php">Cancel</a>
    </fieldset>
    <script src="../asset/confirmDeleteTicket.js"></script> 
</body>
</html>
