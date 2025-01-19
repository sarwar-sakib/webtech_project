<?php
    session_start();
    require_once('../model/ticketModel.php');
    // if(!isset($_COOKIE['status'])){
    //     header('location: login.html');  
    // }
    if(!isset($_SESSION['status'])){
        header('location: login.html');  
    }
    elseif($_SESSION['user']['account_type'] == 'admin'){
        header('location: home.php');
    }

    $tickets = getUserTicket($_SESSION['user']['id']);
    $_SESSION['ticket_requested'] = $tickets;
?>

<html lang="en">
<head>
    <title>My Tickets</title>
</head>
<body align="center">
    <fieldset>
        <legend>My Tickets</legend>
        <h2 align="center">Tickets List</h2>
        <table border=1 cellspacing=0 align="center">
            <tr>
                <th>Ticket Description</th>
                <th>Ticket Status</th>
                <th>Response</th>
            </tr>
            <?php 
                for($i = 0; $i < count($tickets); $i++){ 
            ?>
            <tr align="center">
                <td><?php echo $tickets[$i]['ticket_desc']; ?></td>
                <td><?=$tickets[$i]['ticket_status'] ?></td>
                <td><?=$tickets[$i]['ticket_solution'] ?></td> 
            </tr>
            <?php } ?>
        </table>
        <br>
        <a href="viewFAQ.php"> Back </a> |
        <a href="../controller/logout.php"> logout </a>
    </fieldset>
</body>
</html>
