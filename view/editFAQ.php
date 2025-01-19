<?php
session_start();
require_once('../model/faqModel.php');

if (!isset($_SESSION['status'])) {
    header('location: login.html');
    exit();
} elseif ($_SESSION['user']['account_type'] != 'admin') {
    header('location: home.php');
    exit();
}

$campaign = getFAQ($_REQUEST['id']);
$_SESSION['faq_update_id'] = $_REQUEST['id'];
?>

<html>
<head>
    <title>Edit FAQ</title>
</head>
<body align="center">
    <fieldset>
        <legend>Edit FAQ</legend>
        <h2>Edit FAQ</h2>
        <form id="editFAQForm" onsubmit="return false;">
            <table border="0" cellspacing="0" align="center">
                <tr>
                    <td align="left"><b>Topic</b></td>
                    <td>
                        <textarea name="faq_topic" placeholder="Minimum 5 chars length, no special chars" rows="4" cols="50" onkeyup="validateFAQTopic()"><?=$campaign['faq_topic']?></textarea>
                    </td>
                    <td><p id="faqTopicMessage"></p></td>
                </tr>
                <tr>
                    <td align="left"><b>Question</b></td>
                    <td>
                        <textarea name="faq_question" placeholder="Minimum 5 chars length, no special chars" rows="4" cols="50" onkeyup="validateFAQQuestion()"><?=$campaign['faq_question']?></textarea>
                    </td>
                    <td><p id="faqQuestionMessage"></p></td>
                </tr>
                <tr>
                    <td align="left"><b>Answer</b></td>
                    <td>
                        <textarea name="faq_answer" placeholder="Minimum 5 chars length, no special chars" rows="4" cols="50" onkeyup="validateFAQAnswer()"><?=$campaign['faq_answer']?></textarea>
                    </td>
                    <td><p id="faqAnswerMessage"></p></td>
                </tr>
                <tr> 
                    <td colspan="2" align="center">
                        <input type="button" value="Submit" onclick="ajaxUpdateFAQ()" />
                    </td>
                </tr>
            </table>
            <br>
        </form>
        <?php if ($_SESSION['requested_faq_from'] == 'home.php') { ?>
            <a href="home.php">Cancel</a>
        <?php } else { ?>
            <a href="viewFAQ.php">Cancel</a>
        <?php } ?>
    </fieldset>
    <script src="../asset/updateFAQ.js"></script>
</body>
</html>
