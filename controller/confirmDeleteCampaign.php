<?php
session_start();
require_once('../model/campaignModel.php');

if (isset($_REQUEST['submit'])) {
    $campaign_id = $_SESSION['campaign_delete_id'];

    $status = deleteCampaign($campaign_id);

    if ($status) {
        echo "success"; 
        unset($_SESSION['campaign_delete_id']);  
        exit();
    } else {
        echo "error"; 
    }
} else {
    echo "submit error";
}
?>
