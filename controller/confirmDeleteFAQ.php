<?php 
session_start();
require_once('../model/faqModel.php');

if (isset($_REQUEST['submit'])) {

    $faq_id = $_SESSION['faq_delete_id'];

    $status = deleteFAQ($faq_id);

    if ($status) {
        echo "success"; 
        unset($_SESSION['faq_delete_id']);  
    } else {
        echo "error"; 
    }
} else {
    echo "submit error";
}
?>
