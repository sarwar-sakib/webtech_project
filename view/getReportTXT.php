<?php
    session_start();
    require_once('../model/campaignModel.php');

    // Check session status
    if (!isset($_SESSION['status'])) {
        header('location: login.html');  
    } 
    elseif(!isset($_REQUEST['submit'])){
        header('location: home.php');
    }

    $campaigns = $_SESSION['report_requested'];

    if (!is_array($campaigns)) {
        die('<b>Error:</b> Invalid campaigns data. Expected a valid associative array.');
    }

    function arrayToTxt($data, $indent = 0) {
        $txt = '';
        $prefix = str_repeat('  ', $indent);
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $txt .= $prefix . "$key:\n";
                $txt .= arrayToTxt($value, $indent + 1);
            } else {
                $txt .= $prefix . "$key: $value\n";
            }
        }
        return $txt;
    }

    $txtContent = arrayToTxt($campaigns);
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="campaigns.txt"');

    // Unset the session variable
    // unset($_SESSION['report_requested']);

    // Output the plain text content
    echo $txtContent;
?>
