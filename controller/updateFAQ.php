<?php
session_start();
require_once('../model/faqModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $info = $_REQUEST['info'];
    $data = json_decode($info, true);
    if (isset($_REQUEST['submit'])) {
        $faq_topic = trim($data['faq_topic']);
        $faq_question = trim($data['faq_question']);
        $faq_answer = trim($data['faq_answer']);

        if (empty($faq_topic) || empty($faq_question) || empty($faq_answer)) {
            echo "Null Entries";
        }

        elseif (strpos($faq_topic, "'") !== false || strpos($faq_topic, '"') !== false ||
                strpos($faq_question, "'") !== false || strpos($faq_question, '"') !== false ||
                strpos($faq_answer, "'") !== false || strpos($faq_answer, '"') !== false) {
            echo "Entries cannot contain single quotes (') or double quotes (\")";
        }
        else {
            $status = updateFAQ($_SESSION['faq_update_id'], $faq_topic, $faq_question, $faq_answer);
            if ($status) {
                echo "success"; 
            } else {
                echo "An error occurred while adding the FAQ.";
            }
        }
    } else {
        header('location: ../view/login.html');
    }
}
?>
