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
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            text-align: center;
        }
        fieldset {
            margin: 20px auto;
            border: 1px solid #007bff;
            width: 90%;
            max-width: 600px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        legend {
            font-size: 20px;
            color: #007bff;
            padding: 0 10px;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        td {
            padding: 10px;
            text-align: left;
        }
        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="button"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="button"]:hover {
            background-color: #0056b3;
        }
        p {
            font-size: 14px;
            color: red;
            margin-top: 5px;
        }
        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            display: inline-block;
            margin-top: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
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
