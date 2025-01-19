<?php 
session_start();
require_once('../model/campaignModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $info = $_REQUEST['info'];
    $data = json_decode($info, true);

    if (isset($data['submit'])) {
        $campaign_name = trim($data['campaign_name']);
        $campaign_domain = trim($data['campaign_domain']);
        $budget = trim($data['budget']);
        $expire_date = trim($data['expire_date']);

        if (empty($campaign_name) || empty($campaign_domain) || empty($budget) || empty($expire_date)) {
            echo "Null entries are not allowed.";
        } elseif (strlen($campaign_name) < 4 || strlen($campaign_domain) < 4) {
            echo "Campaign name and domain must be at least 4 characters long.";
        } elseif (!is_numeric($budget) || $budget < 0) {
            echo "Budget must be a non-negative numeric value.";
        } elseif (containsSpecialChars($campaign_name)) {
            echo "Campaign name cannot contain special characters.";
        } elseif (containsSpecialChars($campaign_domain)) {
            echo "Campaign domain cannot contain special characters.";
        } else {
            // Add campaign logic
            $status = addCampaign($campaign_name, $campaign_domain, $budget, $expire_date);
            if ($status) {
                echo "success";
            } else {
                echo "Failed to add campaign. Please try again.";
            }
        }
    } else {
        echo "Invalid request.";
    }
} else {
    header('location: ../view/login.html');
}

function containsSpecialChars($string) {
    $length = strlen($string);
    for ($i = 0; $i < $length; $i++) {
        $char = $string[$i];
        if (!(ctype_alnum($char) || $char === ' ')) {
            return true;
        }
    }
    return false;
}
?>
