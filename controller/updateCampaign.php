<?php 
session_start();
require_once('../model/campaignModel.php');
$current_date = date("Y-m-d");

if (isset($_POST['info'])) {
    $data = json_decode($_POST['info'], true);

    $campaign_name = trim($data['campaign_name']);
    $campaign_domain = trim($data['campaign_domain']);
    $website_url = trim($data['website_url']);
    $budget = trim($data['budget']);
    $expire_date = $data['expire_date'];

    if (empty($campaign_name) || empty($campaign_domain) || empty($budget) || empty($expire_date)) {
        echo "Null Entries";
    } 
    elseif (strlen($campaign_name) < 4 || strlen($campaign_domain) < 4) {
        echo "Campaign name and domain must each be at least 4 characters long.";
    }
    elseif ($expire_date < $current_date) {
        echo "A past date was entered.";
    }
    elseif (!empty($website_url) && !isValidUrl($website_url)) {
        echo "Enter a valid web address.";
    } 
    elseif (!is_numeric($budget) || $budget < 0) {
        echo "Budget must be a non-negative numeric value.";
    } 
    else {
        $status = updateCampaign($_SESSION['campaign_update_id'], $campaign_name, $campaign_domain, $website_url, $budget, $expire_date);
        
        if ($status) {
            echo "success"; 
        } else {
            echo "An error occurred";
        }
    }
} else {
    echo "Invalid request";
}

function isValidUrl($url) {
    if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {
        $url_without_scheme = parse_url($url, PHP_URL_HOST);
        if ($url_without_scheme && strlen($url_without_scheme) > 0) {
            return true; 
        }
    }
    return false; 
}
?>
