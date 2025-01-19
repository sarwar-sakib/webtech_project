<?php
session_start();
require_once('../model/campaignModel.php');

if (!isset($_SESSION['status'])) {
    header('location: login.html');
    exit();
} elseif ($_SESSION['user']['account_type'] != 'admin') {
    header('location: home.php');
    exit();
}

$campaign = getCampaign($_REQUEST['campaign_id']);
$_SESSION['campaign_update_id'] = $_REQUEST['campaign_id'];
?>

<html>
<head>
    <title>Edit Campaign</title>
</head>
<body align="center">
    <fieldset>
        <legend>Edit Campaign</legend>
        <h2>Edit Campaign</h2>
        <form id="editCampaignForm" onsubmit="return false;"> 
            <table border="0" cellspacing="0" align="center">
                <tr>
                    <td align="left"><b>Campaign Name</b></td>
                    <td>
                        <input type="text" id="campaignName" name="campaign_name" value="<?=$campaign['campaign_name']?>" onkeyup="validateCampaignName()" />
                    </td>
                    <td><p id="campaignNameMessage"></p></td>
                </tr>
                <tr>
                    <td align="left"><b>Domain</b></td>
                    <td>
                        <input type="text" id="campaignDomain" name="campaign_domain" value="<?=$campaign['campaign_domain']?>" onkeyup="validateCampaignDomain()" />
                    </td>
                    <td><p id="campaignDomainMessage"></p></td>
                </tr>
                <tr>
                    <td align="left"><b>URL</b></td>
                    <td>
                        <input type="text" id="websiteUrl" name="website_url" placeholder="http://www.example.com" value="<?=$campaign['website_url']?>" onkeyup="validateWebsiteUrl()" />
                    </td>
                    <td><p id="websiteUrlMessage"></p></td>
                </tr>
                <tr>
                    <td align="left"><b>Webmaster ID</b></td>
                    <td><?=$campaign['webmaster_id']?></td>
                </tr>
                <tr>
                    <td align="left"><b>Advertising Brand</b></td>
                    <td><?=$campaign['advertising_brand']?></td>
                </tr>
                <tr>
                    <td align="left"><b>Advertiser ID</b></td>
                    <td><?=$campaign['advertiser_id']?></td>
                </tr>
                <tr>
                    <td align="left"><b>Status</b></td>
                    <td><?=$campaign['status']?></td>
                </tr>
                <tr>
                    <td align="left"><b>Budget (USD)</b></td>
                    <td>
                        <input type="text" id="budget" name="budget" value="<?=$campaign['budget']?>" onkeyup="validateBudget()" />
                    </td>
                    <td><p id="budgetMessage"></p></td>
                </tr>
                <tr>
                    <td align="left"><b>Expire Date</b></td>
                    <td>
                        <input type="date" id="expireDate" name="expire_date" value="<?=$campaign['expire_date']?>" onchange="validateExpireDate()" />
                    </td>
                    <td><p id="expireDateMessage"></p></td>
                </tr>
            </table>
            <br>
            <input type="button" value="Submit" onclick="ajaxUpdateCampaign()" />
        </form>
        <?php if ($_SESSION['requested_from'] == 'home.php') { ?>
            <a href="home.php">Cancel</a>
        <?php } else { ?>
            <a href="campaignList.php">Cancel</a>
        <?php } ?>
    </fieldset>
    <script src="../asset/editCampaign.js"></script>
</body>
</html>
