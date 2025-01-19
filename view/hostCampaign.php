<?php
    session_start();
    require_once('../model/campaignModel.php');
    // if(!isset($_COOKIE['status'])){
    //     header('location: login.html');  
    // }
    if(!isset($_SESSION['status'])){
        header('location: login.html');  
    }
    elseif($_SESSION['user']['account_type'] != 'webmaster'){
        header('location: home.php');
    }
    // if(isset($_REQUEST['id'])){
    //     echo $_REQUEST['id'];
    // }
    // echo $_REQUEST['campaign_id'];
    $campaign = getCampaign($_REQUEST['campaign_id']);
    $_SESSION['campaign_host_id'] = $_REQUEST['campaign_id'];
    // print_r($campaign);
?>

<html>
<head>
    <title>Host Page</title>
</head>
<body align="center">
    <fieldset>
        <legend>Campaign Details</legend>
        <h2>Campaign Details</h2>
        <form id="hostCampaignForm" onsubmit="return false;"> 
            <table align="center">
                <tr align="center">
                    <td><b>Campaign ID:</b></td>
                    <td><?=$campaign['campaign_id']?></td>
                </tr>
                <tr align="center">
                    <td><b>Campaign Name:</b></td>
                    <td><?=$campaign['campaign_name']?></td>
                </tr>
                <tr align="center">
                    <td><b>Domain:</b></td>
                    <td><?=$campaign['campaign_domain']?></td>
                </tr>
                <tr align="center">
                    <td><b>Advertising Brand:</b></td>
                    <td><?=$campaign['advertising_brand']?></td>
                </tr>
                <tr align="center">
                    <td><b>Advertiser ID:</b></td>
                    <td><?=$campaign['advertiser_id']?></td>
                </tr>
                <tr align="center">
                    <td><b>Status:</b></td>
                    <td><?=$campaign['status']?></td>
                </tr>
                <tr align="center">
                    <td><b>Budget (USD):</b></td>
                    <td><?=$campaign['budget']?></td>
                </tr>
                <tr align="center">
                    <td><b>Expire Date:</b></td>
                    <td><?=$campaign['expire_date']?></td>
                </tr>
            </table>
            <hr>
            <p align="center"><b>Your Webmaster ID:</b> <?=$_SESSION['user']['id']?></p>
            <p align="center"><b>URL:</b> <input type="text" name="website_url" id="website_url" placeholder="http://www.example.com/home.html" value="" onkeyup="validateWebsiteURL()" /></p>
            
            <p id="websiteURLMessage" style="color: red;"></p>

            <p align="center"><input type="button" value="Submit" onclick="ajaxHostCampaign()" /></p>
        </form>
        <?php 
            if($_SESSION['requested_from'] == 'home.php'){
        ?>
        <a href="home.php">Cancel</a> 
        <?php }else { ?>
        <a href="campaignList.php">Cancel</a> 
        <?php } ?>
    </fieldset>
    <script src="../asset/confirmHostCampaign.js"></script>
</body>
</html>
