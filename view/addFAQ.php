<html>
<head>
    <title>Add New FAQ</title>
</head>
<body align="center">
    <fieldset>
        <legend>Add New FAQ</legend>
        <h2>Add New FAQ</h2>
        <form id="faqForm" onsubmit="return false;">
            <table align="center">
                <tr>
                    <td>FAQ Topic:</td>
                    <td><textarea name="faq_topic" id="faq_topic" placeholder="Minimum 5 chars length, no special chars" rows="4" cols="50" onkeyup="validateFAQTopic()"></textarea></td>
                    <td><p id="faqTopicMessage"></p></td>
                </tr>
                <tr>
                    <td>Question:</td>
                    <td><textarea name="faq_question" id="faq_question" placeholder="Minimum 5 chars length, no special chars" rows="4" cols="50" onkeyup="validateFAQQuestion()"></textarea></td>
                    <td><p id="faqQuestionMessage"></p></td>
                </tr>
                <tr>
                    <td>Answer:</td>
                    <td><textarea name="faq_answer" id="faq_answer" placeholder="Minimum 5 chars length, no special chars" rows="4" cols="50" onkeyup="validateFAQAnswer()"></textarea></td>
                    <td><p id="faqAnswerMessage"></p></td>
                </tr>
                <tr>
                    <td colspan="3" align="center">
                        <input type="button" name="submit" value="Submit" onclick="ajaxAddFAQ()" />
                    </td>
                </tr>
            </table>
        </form>
        <a href="viewFAQ.php">Cancel</a>
    </fieldset>
    <script src="../asset/confirmAddFAQ.js"></script>
</body>
</html>
