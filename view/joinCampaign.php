<?php
    session_start();
    require_once('../model/campaignModel.php');

    if (!isset($_SESSION['status'])) {
        header('location: login.html');  
    } elseif ($_SESSION['user']['account_type'] != 'advertiser') {
        header('location: home.php');
    }

    $campaign = getCampaign($_REQUEST['campaign_id']);
    $_SESSION['campaign_join_id'] = $_REQUEST['campaign_id'];
?>

<html>
<head>
    <title>Join Campaign</title>
</head>
<body align="center">
    <fieldset>
        <legend>Campaign Details</legend>
        <h2>Campaign Details</h2>
        <form id="joinCampaignForm" onsubmit="return false;">
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
            <table align="center">
                <tr>
                    <td align="left"><b>Advertising Brand:</b></td>
                    <td>
                        <input type="text" name="advertising_brand" id="advertising_brand" placeholder="Enter brand name" onkeyup="validateAdvertisingBrand()" />
                    </td>
                </tr>
            </table>

            <!-- Message for validation result -->
            <p id="advertisingBrandMessage" style="color: red;"></p>

            <p align="center"><h4>Are you sure you want to join?</h4></p>
            <p align="center"><input type="button" value="Join" onclick="ajaxJoinCampaign()" /></p>
        </form>
        <?php 
            if ($_SESSION['requested_from'] == 'home.php') {
        ?>
        <a href="home.php">Cancel</a> 
        <?php } else { ?>
        <a href="campaignList.php">Cancel</a> 
        <?php } ?>
    </fieldset>
    <script src="../asset/confirmJoinCampaign.js"></script>
</body>
</html>
