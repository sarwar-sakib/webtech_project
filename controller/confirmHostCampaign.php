<?php 
session_start();
require_once('../model/campaignModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_REQUEST['submit'])) {
        $webmaster_id = trim($_SESSION['user']['id']);
        $website_url = trim($_REQUEST['website_url']);

        if (empty($webmaster_id) || empty($website_url)) {
            echo "Null Entries"; 
        }
        elseif (!isValidUrl($website_url)) {
            echo "Enter a valid web address.";
        } 
        else {
            $status = hostCampaign($_SESSION['campaign_host_id'], $webmaster_id, $website_url);
            if ($status) {
                echo "success"; 
                unset($_SESSION['campaign_host_id']);
            } else {
                echo "An error occurred while hosting the campaign.";
            }
        }
    } else {
        header('Location: ../view/login.html');
    }
} else {
    echo "Invalid request.";
}

function isValidUrl($url) {
    $parsedUrl = parse_url($url);
    
    if ($parsedUrl === false) {
        return false;
    }

    $scheme = isset($parsedUrl['scheme']) ? strtolower($parsedUrl['scheme']) : '';
    $host = isset($parsedUrl['host']) ? $parsedUrl['host'] : '';

    if (($scheme === 'http' || $scheme === 'https') && !empty($host)) {
        return true;
    }

    return false;
}
?>
