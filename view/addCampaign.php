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
