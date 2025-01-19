<?php
    session_start();
    require_once('../model/campaignModel.php');
    // if(!isset($_COOKIE['status'])){
    //     header('location: login.html');  
    // }
    if(!isset($_SESSION['status'])){
        header('location: login.html');  
    }
    elseif($_SESSION['user']['account_type'] != 'advertiser'){
        header('location: home.php');
    }
    // if(isset($_REQUEST['id'])){
    //     echo $_REQUEST['id'];
    // }
    // echo $_REQUEST['campaign_id'];
    $campaign = getCampaign($_REQUEST['campaign_id']);
    $_SESSION['campaign_leave_id'] = $campaign['campaign_id'];
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
        <form method="post" action="../controller/confirmLeaveCampaign.php" enctype=""> 
            <table align="center">
                <tr>
                    <td align="left"><b>Campaign ID:</b></td>
                    <td><?=$campaign['campaign_id']?></td>
                </tr>
                <tr>
                    <td align="left"><b>Campaign Name:</b></td>
                    <td><?=$campaign['campaign_name']?></td>
                </tr>
                <tr>
                    <td align="left"><b>Domain:</b></td>
                    <td><?=$campaign['campaign_domain']?></td>
                </tr>
                <tr>
                    <td align="left"><b>Webmaster ID:</b></td>
                    <td><?=$campaign['webmaster_id']?></td>
                </tr>
                <tr>
                    <td align="left"><b>URL:</b></td>
                    <td><?=$campaign['website_url']?></td>
                </tr>
                <tr>
                    <td align="left"><b>Status:</b></td>
                    <td><?=$campaign['status']?></td>
                </tr>
                <tr>
                    <td align="left"><b>Budget (USD):</b></td>
                    <td><?=$campaign['budget']?></td>
                </tr>
                <tr>
                    <td align="left"><b>Expire Date:</b></td>
                    <td><?=$campaign['expire_date']?></td>
                </tr>
            </table>
            <hr>
            <p align="center"><b>Your Advertiser ID:</b> <b><?=$campaign['advertiser_id']?></b></p>
            <p align="center"><b>Your Advertising Brand:</b> <b><?=$campaign['advertising_brand']?></b></p>
            <p align="center"><h3> Are you sure you want to leave the campaign? </h3></p>
            <p align="center"><input type="submit" name="submit" value="Yes" /></p>
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
