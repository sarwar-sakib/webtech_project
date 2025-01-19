<?php
    session_start();
    require_once('../model/faqModel.php');
    // if(!isset($_COOKIE['status'])){
    //     header('location: login.html');  
    // }
    if(!isset($_SESSION['status'])){
        header('location: login.html');  
    }
    // elseif($_SESSION['user']['account_type'] != 'admin'){
    //     header('location: home.php');
    // }

    $faqs = getAllFAQ();
    $_SESSION['requested_faq_from'] = basename($_SERVER['PHP_SELF']);
    $_SESSION['ticket_requested_from'] = basename($_SERVER['PHP_SELF']);
?>

<html lang="en">
<head>
    <title>FAQ / Tickets</title>
</head>
<body align="center">
    <fieldset>
        <legend>FAQ / Tickets</legend>
        <h2>FAQ</h2>
        <?php if($_SESSION['user']['account_type'] == 'admin') { ?>
            <a href="addFAQ.php"> Add new FAQ </a> <br>
            <a href="viewTickets.php"> View Tickets </a>
        <?php } else { ?>
            <a href="addTicket.php"> File Ticket </a> <br> 
            <a href="myTickets.php"> My Tickets </a>
        <?php } ?>
        <hr>
        <?php for($i = 0; $i < count($faqs); $i++) { ?>
            <p align="center"> <b>Topic</b> <br> <?php echo $faqs[$i]['faq_topic']; ?></p>
            <p align="center"> <b>Question</b> <br> <?php echo $faqs[$i]['faq_question']; ?></p>
            <p align="center"> <b>Answer</b> <br> <?php echo $faqs[$i]['faq_answer']; ?></p>
            <?php if($_SESSION['user']['account_type'] == 'admin') { ?>
                <a href="editFAQ.php?id=<?=$faqs[$i]['faq_id']?>"> EDIT </a> | 
                <a href="deleteFAQ.php?id=<?=$faqs[$i]['faq_id']?>"> DELETE </a>
            <?php } ?>
            <hr>
        <?php } ?>
        <br>
        <a href="home.php"> Back </a> | 
        <a href="../controller/logout.php"> logout </a>
    </fieldset>
</body>
</html>
