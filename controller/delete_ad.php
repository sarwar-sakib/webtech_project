<?php
    session_start();
    require_once('../model/adModel.php');

    if (isset($_GET['id'])) {
        $adId = intval($_GET['id']);
        if (deleteAd($adId)) {
            echo 'success'; 
        } else {
            echo 'failure'; 
        }
    } else {
        echo 'failure'; 
    }
?>
