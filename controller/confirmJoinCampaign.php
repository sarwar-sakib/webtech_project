<?php 
session_start();
require_once('../model/campaignModel.php');

if (isset($_REQUEST['submit'])) {
    $advertiser_id = trim($_SESSION['user']['id']);
    $advertising_brand = trim($_REQUEST['advertising_brand']);

    if (empty($advertiser_id) || empty($advertising_brand)) {
        echo "Empty Entries";
    } elseif (strlen($advertising_brand) < 3) {
        echo "Advertising brand must be at least 3 characters long.";
    } elseif (!isValidBrandName($advertising_brand)) {
        echo "Only letters, numbers, and white space allowed.";
    } else {
        $status = joinCampaign($_SESSION['campaign_join_id'], $advertising_brand, $advertiser_id);
        if ($status) {
            echo "success";
            unset($_SESSION['campaign_join_id']);
        } else {
            echo "An error occurred";
            ?>
            <a href="../view/campaignList.php">Return to Campaign List</a>
            <?php
        }
    }
} else {
    echo "Invalid request";
}

function isValidBrandName($brand) {
    for ($i = 0; $i < strlen($brand); $i++) {
        $char = $brand[$i];
        if (!ctype_alnum($char) && $char != ' ') {
            return false; 
        }
    }
    return true; 
}
?>
