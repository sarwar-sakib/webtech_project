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
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            text-align: center;
            padding: 20px;
        }
        fieldset {
            background-color: #ffffff;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
            text-align: left;
            width: 80%;
            max-width: 700px;
            margin: 0 auto;
        }
        legend {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        p {
            margin: 10px 0;
            line-height: 1.6;
        }
        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            margin-right: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
        hr {
            border: 0;
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }
        input[type="button"], input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 10px;
        }
        input[type="button"]:hover, input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
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
