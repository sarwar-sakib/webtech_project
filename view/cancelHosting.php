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
    $_SESSION['campaign_cancel_host_id'] = $campaign['campaign_id'];
    // print_r($campaign);
?>

<html>
<head>
    <title>Cancel Hosting</title>
</head>
<body align="center">
    <fieldset>
        <legend>Campaign Details</legend>
        <h2>Campaign Details</h2>
        <form method="post" action="../controller/confirmCancelHosting.php" enctype=""> 
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
            <p align="center">Your Webmaster ID: <b><?=$_SESSION['user']['id']?></b></p>
            <p align="center">URL: <b><?=$campaign['website_url']?></b></p>
            <h3 align="center">Are you sure you want to cancel hosting?</h3>
            <input type="submit" name="submit" value="Yes" />
        </form>
        <?php 
            if($_SESSION['requested_from'] == 'home.php'){
        ?>
        <a href="home.php">No</a> 
        <?php }else { ?>
        <a href="../view/campaignList.php">No</a>
        <?php } ?>
    </fieldset>
</body>
</html>
