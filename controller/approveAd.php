<?php
session_start();
require_once('../model/adModel.php');

if (!isset($_SESSION['user']) || $_SESSION['user']['account_type'] !== 'admin') {
    die("Access denied: You are not authorized to perform this action.");
}

if (isset($_GET['id'])) {
    $adId = intval($_GET['id']);
    $adminId = $_SESSION['user']['id'];

    $adDetails = getSubmittedAdId($adId); 


    if ($adDetails && $adDetails['status'] === 'Approved') {
        echo "This ad has already been approved.";
        exit;
    }

    // Approve the ad
       if ($adDetails && $adDetails['status'] === 'Pending') {
        if (approveAd($adId, $adminId)) {
            echo "Ad approved successfully!";
        } else {
            echo "Failed to approve the ad.";
        }
    } else {
        echo "This ad is not in a pending status, approval cannot proceed.";
    }
} else {
    echo "Invalid request: Ad ID not provided.";
}
?>
