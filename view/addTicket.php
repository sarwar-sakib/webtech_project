<?php
    session_start();
    require_once('../model/ticketModel.php');

    if (!isset($_SESSION['status'])) {
        header('location: login.html');  
    } elseif ($_SESSION['user']['account_type'] == 'admin') {
        header('location: home.php');
    }
?>

<html>
<head>
    <title>File Ticket</title>
</head>
<body align="center">
    <fieldset>
        <legend>File Ticket</legend>
        <h2 align="center">New Ticket</h2>
        <form id="fileTicketForm" onsubmit="return false;"> <!-- Prevent default form submission -->
            <table align="center">
                <tr>
                    <td><label for="ticket_desc">Ticket Description:</label></td>
                    <td>
                        <textarea name="ticket_desc" id="ticket_desc" placeholder="Minimum 5 chars length, no special chars" rows="4" cols="50" onkeyup="validateTicketDescription()"></textarea>
                    </td>
                </tr>
            </table>

            <p id="ticketDescMessage"></p>

            <p align="center">
                <input type="button" value="Submit" onclick="ajaxFileTicket()" />
            </p>
        </form>
        <br>
        <?php 
            if ($_SESSION['ticket_requested_from'] == 'home.php') {
        ?>
        <a href="home.php">Cancel</a>
        <?php } else { ?>
        <a href="viewFAQ.php">Cancel</a>
        <?php } ?>
    </fieldset>
    <script src="../asset/confirmAddTicket.js"></script>
</body>
</html>
