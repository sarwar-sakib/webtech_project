<?php
session_start();
require_once('../model/ticketModel.php');

if (!isset($_SESSION['status'])) {
    header('location: login.html');
    exit();
} elseif ($_SESSION['user']['account_type'] != 'admin') {
    header('location: home.php');
    exit();
}

$ticket = getTicket($_REQUEST['id']);
$_SESSION['ticket_responded_id'] = $_REQUEST['id'];
?>

<html>
<head>
    <title>Respond to Ticket</title>
</head>
<body align="center">
    <fieldset>
        <legend>Respond to Ticket</legend>
        <h2>Respond Ticket</h2>
        <form id="respondTicketForm" onsubmit="return false;">
            <table border="0" cellspacing="0" align="center">
                <tr>
                    <td align="left"><b>From:</b></td>
                    <td><b><?=$ticket['ticket_from']?></b></td>
                </tr>
                <tr>
                    <td align="left"><b>Description:</b></td>
                    <td><b><?=$ticket['ticket_desc']?></b></td>
                </tr>
                <tr>
                    <td align="left"><b>Status:</b></td>
                    <td><b><?=$ticket['ticket_status']?></b></td>
                </tr>
                <tr>
                    <td align="left"><b>Response:</b></td>
                    <td>
                        <input type="text" id ="ticket_solution" name="ticket_solution" value="<?=$ticket['ticket_solution']?>" onkeyup="validateTicketSolution()" />
                    </td>
                    <td><p id="ticketSolutionMessage"></p></td>
                </tr>
            </table>
            <br>
            <input type="button" value="Submit" onclick="ajaxUpdateTicket()" />
        </form>
        <?php if ($_SESSION['ticket_responded_from'] == 'home.php') { ?>
            <a href="home.php">Cancel</a>
        <?php } else { ?>
            <a href="viewTickets.php">Cancel</a>
        <?php } ?>
    </fieldset>
    <script src="../asset/updateTicket.js"></script>
</body>
</html>
