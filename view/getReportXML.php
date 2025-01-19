<?php
    session_start();
    require_once('../model/campaignModel.php');
    // if(!isset($_COOKIE['status'])){
    //     header('location: login.html');  
    // }
    if(!isset($_SESSION['status'])){
        header('location: login.html');  
    }
    // elseif($_SESSION['user']['account_type'] != 'admin'){
    //     header('location: home.php');
    // }
    elseif(!isset($_REQUEST['submit'])){
        header('location: home.php');
    }
    
    $campaigns = $_SESSION['report_requested'];

    if (!is_array($campaigns)) {
        die('<b>Error:</b> Invalid campaigns data. Expected a valid associative array.');
    }
    
    function arrayToXml($data, &$xml) {
        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                $key = "item$key";
            }
            if (is_array($value)) {
                $subnode = $xml->addChild($key);
                arrayToXml($value, $subnode);
            } else {
                $xml->addChild($key, htmlspecialchars($value));
            }
        }
    }

    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><campaigns/>');
    
    // Convert campaigns array to XML
    arrayToXml($campaigns, $xml);

    header('Content-Type: application/xml');
    header('Content-Disposition: attachment; filename="campaigns.xml"');
    
    // unset($_SESSION['report_requested']);
    // Print XML content
    echo $xml->asXML();
?>

