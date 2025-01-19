<?php
    session_start();
    require_once('../model/campaignModel.php');
    if (!isset($_SESSION['status'])) {
        header('location: login.html');
    } elseif ($_SESSION['user']['account_type'] != 'admin') {
        header('location: home.php');
    }
?>

<html>
<head>
    <title>Add Campaign</title>
</head>
<body align="center">
    <fieldset>
        <legend>Add New Campaign</legend>
        <h2>Add New Campaign</h2>
        <form id="addCampaignForm" onsubmit="return false;">
            <table align="center">
                <tr align="center">
                    <td>Campaign Name:</td>
                    <td>
                        <input 
                            type="text" 
                            id="campaignName" 
                            name="campaign_name" 
                            placeholder="Minimum 4 chars length" 
                            onkeyup="validateCampaignName()" 
                        />
                    </td>
                    </tr>
                    <tr align="center">
                        <td colspan=2><p id="campaignNameMessage"></p></td>
                    </tr>
                <tr align="center">
                    <td>Domain:</td>
                    <td>
                        <input 
                            type="text" 
                            id="campaignDomain" 
                            name="campaign_domain" 
                            placeholder="Minimum 4 chars length" 
                            onkeyup="validateCampaignDomain()" 
                        />
                    </td>
                    </tr>
                    <tr align="center">
                    <td colspan=2><p id="campaignDomainMessage"></p></td>
                </tr>
                <tr align="center">
                    <td>Budget (USD):</td>
                    <td>
                        <input 
                            type="text" 
                            id="budget" 
                            name="budget" 
                            placeholder="Numeric non-negative value" 
                            onkeyup="validateBudget()" 
                        />
                    </td>
                    </tr>
                    <tr align="center">
                    <td colspan=2><p id="budgetMessage"></p></td>
                </tr>
                <tr align="center">
                    <td>Expire Date:</td>
                    <td>
                        <input 
                            type="date" 
                            id="expireDate" 
                            name="expire_date" 
                            onkeyup="validateExpireDate()" 
                            onchange="validateExpireDate()" 
                        />
                    </td>
                    </tr>
                    <tr align="center">
                    <td colspan=2><p id="expireDateMessage"></p></td>
                </tr>
                <tr>
                    <td colspan="3" align="center">
                        <input type="button" value="Submit" onclick="ajaxAddCampaign()" />
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if ($_SESSION['requested_from'] == 'home.php') {
        ?>
        <a href="home.php">Cancel</a> 
        <?php } else { ?>
        <a href="campaignList.php">Cancel</a>
        <?php } ?>
    </fieldset>
    <script src="../asset/addCampaign.js"></script>
</body>
</html>

