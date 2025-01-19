<?php
session_start();
require_once('../model/faqModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $info = $_REQUEST['info'];
    $data = json_decode($info, true);

    if (isset($data['submit'])) {
        $faq_topic = trim($data['faq_topic']);
        $faq_question = trim($data['faq_question']);
        $faq_answer = trim($data['faq_answer']);

        if (empty($faq_topic) || empty($faq_question) || empty($faq_answer)) {
            echo "Null Entries";
        } elseif (strpos($faq_topic, "'") !== false || strpos($faq_topic, '"') !== false ||
                  strpos($faq_question, "'") !== false || strpos($faq_question, '"') !== false ||
                  strpos($faq_answer, "'") !== false || strpos($faq_answer, '"') !== false) {
            echo "Entries cannot contain single quotes (') or double quotes (\")";
        } elseif (strlen($faq_topic) < 5 || strlen($faq_question) < 5 || strlen($faq_answer) < 5) {
            echo "All fields must be at least 5 characters long.";
        } else {
            $status = addFAQ($faq_topic, $faq_question, $faq_answer);
            if ($status) {
                echo "success"; 
            } else {
                echo "An error occurred while adding the FAQ.";
            }
        }
    }
} else {
    header('Location: ../view/login.html');
}
?>
