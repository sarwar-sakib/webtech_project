<?php
// USER ONLY
session_start();
require_once('../model/adModel.php');

if (!isset($_SESSION['status'])) {
    header('Location: login.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ad_id'])) {
        $adId = $_POST['ad_id'];
        $userId = $_SESSION['user']['id'];

        // Fetch the ad details
        $ad = getAdById($adId);

        if (!$ad || $ad['user_id'] != $userId) {
            die("Ad not found or unauthorized access.");
        }

        
        if (moveAdToSubmitted($adId, $userId)) {
            echo 'success'; 
        } else {
            echo 'failure'; 
        }
    } else {
        die("Ad ID is missing.");
    }
} else {
    die("Invalid request method.");
}
?>
