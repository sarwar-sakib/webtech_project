<?php
    session_start();
    require_once('../model/faqModel.php');

    if (!isset($_SESSION['status'])) {
        header('location: login.html');  
    } elseif ($_SESSION['user']['account_type'] != 'admin') {
        header('location: home.php');
    }

    $campaign = getFAQ($_REQUEST['id']);
    $_SESSION['faq_delete_id'] = $_REQUEST['id'];
?>

<html>
<head>
    <title>DELETE FAQ</title>
</head>
<body align="center">
    <fieldset>
        <legend>Delete FAQ</legend>
        <h2>Delete FAQ</h2>
        <form method="post" onsubmit="return false;">
            <table align="center" border="1" cellspacing="0">
                <tr align="center">
                    <td>FAQ ID</td>
                    <td>FAQ Topic</td>
                    <td>FAQ Question</td>
                    <td>FAQ Answer</td>
                </tr>
                <tr align="center">
                    <td><?=$campaign["faq_id"]?></td>
                    <td><?=$campaign["faq_topic"]?></td>
                    <td><?=$campaign["faq_question"]?></td>
                    <td><?=$campaign["faq_answer"]?></td>
                </tr>
            </table>
            <hr>
            <input type="button" value="Confirm Deletion" onclick="ajaxDeleteFAQ()" />
        </form>
        <br>
        <a href="viewFAQ.php">Cancel</a>
    </fieldset>
    
    <script src="../asset/confirmDeleteFAQ.js"></script>
</body>
</html>
