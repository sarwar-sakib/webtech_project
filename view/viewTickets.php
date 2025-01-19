<?php
    session_start();
    require_once('../model/ticketModel.php');
    // if(!isset($_COOKIE['status'])){
    //     header('location: login.html');  
    // }
    if(!isset($_SESSION['status'])){
        header('location: login.html');  
    }
    elseif($_SESSION['user']['account_type'] != 'admin'){
        header('location: home.php');
    }

    $tickets = getAllTicket();
?>

<html lang="en">
<head>
    <title>Ticket List</title>
</head>
<body align="center">
    <fieldset>
        <legend>Ticket List</legend>
        <h2 align="center">Ticket List</h2>
        <br>
        <table border=1 cellspacing=0 align="center">
            <tr>
                <th>ID</th>
                <th>From</th>
                <th>Description</th>
                <th>Status</th>
                <th>Response</th>
                <th>Action</th>
            </tr>
            <?php 
                for($i = 0; $i < count($tickets); $i++){ 
            ?>
            <tr align="center">
                <td><?php echo $tickets[$i]['ticket_id']; ?></td>
                <td><?=$tickets[$i]['ticket_from'] ?></td>
                <td><?=$tickets[$i]['ticket_desc'] ?></td>
                <td><?=$tickets[$i]['ticket_status'] ?></td>
                <td><?=$tickets[$i]['ticket_solution'] ?></td>
                <td>
                    <a href="respondTicket.php?id=<?=$tickets[$i]['ticket_id']?>"> RESPOND </a> |
                    <a href="deleteTicket.php?id=<?=$tickets[$i]['ticket_id']?>"> DELETE </a> 
                    <?php $_SESSION['ticket_responded_from'] = basename($_SERVER['PHP_SELF']); ?>
                </td>  
            </tr>
            <?php } ?>
        </table>
        <br>
        <a href="viewFAQ.php"> Back </a> | 
        <a href="../controller/logout.php"> logout </a>
    </fieldset>
</body>
</html>
