<?php
    session_start();
    require_once('../model/adModel.php');

    if (isset($_GET['id'])) {
        $adId = intval($_GET['id']);
        if (deleteAd($adId)) {
            echo 'success'; // Respond with success if the ad was deleted
        } else {
            echo 'failure'; // Respond with failure if the ad couldn't be deleted
        }
    } else {
        echo 'failure'; // Respond with failure if no id is passed
    }
?>
