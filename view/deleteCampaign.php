<?php
    session_start();
    require_once('../model/campaignModel.php');
    if (!isset($_SESSION['status'])) {
        header('location: login.html');  
    }
    elseif ($_SESSION['user']['account_type'] != 'admin') {
        header('location: home.php');
    }

    $campaign = getCampaign($_REQUEST['campaign_id']);
    $_SESSION['campaign_delete_id'] = $_REQUEST['campaign_id'];
?>

<html>
<head>
    <title>DELETE Campaign</title>
</head>
<body align="center">
    <fieldset>
        <legend>Delete Campaign</legend>
        <h2>Delete Campaign</h2>
        <form method="post" action="javascript:void(0);" onsubmit="return false;">
            <table border="1" cellspacing="0" align="center">
                <tr>
                    <td align="center"><b>Campaign ID</b></td>
                    <td align="center"><b>Campaign name</b></td>
                    <td align="center"><b>Domain</b></td>
                    <td align="center"><b>URL</b></td>
                    <td align="center"><b>Budget (USD)</b></td>
                    <td align="center"><b>Expire Date</b></td>
                </tr>
                <tr>
                    <td align="center"><?= $campaign["campaign_id"] ?></td>
                    <td align="center"><?= $campaign["campaign_name"] ?></td>
                    <td align="center"><?= $campaign["campaign_domain"] ?></td>
                    <td align="center"><?= $campaign["website_url"] ?></td>
                    <td align="center"><?= $campaign["budget"] ?></td>
                    <td align="center"><?= $campaign["expire_date"] ?></td>
                </tr>
            </table>
            <hr>
            <input type="button" value="Confirm Deletion" onclick="ajaxDelete()" />
        </form>
        <br>
        <a href="campaignList.php">Cancel</a>
    </fieldset>
    
    <script src="../asset/confirmDeleteCampaign.js"></script>
</body>
</html>
