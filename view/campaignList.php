<?php
    session_start();
    require_once('../model/campaignModel.php');
    if(!isset($_SESSION['status'])){
        header('location: login.html');  
    }

    syncStatus();
    $campaigns = getAllCampaign();
    $_SESSION['report_requested'] = $campaigns;
    $_SESSION['requested_from'] = basename($_SERVER['PHP_SELF']);
?>

<html lang="en">
<head>
    <title>Campaign List</title>
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
            max-width: 1200px;
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
        p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e9ecef;
        }
        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .action-links {
            margin-top: 20px;
        }
        .action-links a {
            margin: 0 10px;
            font-size: 14px;
        }
    </style>
</head>
<body align="center">
    <fieldset>
        <legend>Campaign List</legend>
        <h2>Campaign List</h2>    
        <p>Current date: 
            <b><?=date("Y-m-d")?></b>
        </p>
        <?php 
            if($_SESSION['user']['account_type']=="admin") { ?>
            <form method="post" action="getReportXML.php">
                <table align="center">
                    <tr>
                        <td><input type="submit" name="submit" value="Get Report in XML" /></td>
                    </tr>
                </table>
            </form>
            <form method="post" action="getReportTXT.php">
                <table align="center">
                    <tr>
                        <td><input type="submit" name="submit" value="Get Report in TXT" /></td>
                    </tr>
                </table>
            </form>
            <a href="addCampaign.php"> Add Campaign </a> <br><br>
        <?php } 
        if($_SESSION['user']['account_type']!="admin") { ?>
        <a href="myCampaigns.php"> My Campaigns </a>
        <?php } ?>
        <table>
            <tr>
                <th>Campaign ID</th>
                <th>Campaign Name</th>
                <th>Domain</th>
                <th>URL</th>
                <th>Webmaster ID</th>
                <th>Advertising Brand</th>
                <th>Advertiser ID</th>
                <th>Status</th>
                <th>Budget (USD)</th>
                <th>Expire Date</th>
                <th>Action</th>
            </tr>
            <?php 
                for($i=0; $i<count($campaigns); $i++) { ?>
            <tr>
                <td><?php echo $campaigns[$i]['campaign_id']; ?></td>
                <td><?=$campaigns[$i]['campaign_name'] ?></td>
                <td><?=$campaigns[$i]['campaign_domain'] ?></td>
                <td><?=$campaigns[$i]['website_url'] ?></td>
                <td><?=$campaigns[$i]['webmaster_id'] ?></td>
                <td><?=$campaigns[$i]['advertising_brand'] ?></td>
                <td><?=$campaigns[$i]['advertiser_id'] ?></td>
                <td><?=$campaigns[$i]['status'] ?></td>
                <td><?=$campaigns[$i]['budget'] ?></td>
                <td><?=$campaigns[$i]['expire_date'] ?></td>
                <td>
                <?php  
                if($_SESSION['user']['account_type']=="admin") { 
                    if($campaigns[$i]['status']!="Expired") { ?>
                    <a href="editCampaign.php?campaign_id=<?=$campaigns[$i]['campaign_id']?>"> EDIT </a> |
                    <a href="deleteCampaign.php?campaign_id=<?=$campaigns[$i]['campaign_id']?>"> DELETE </a> 
                <?php } else { ?>
                    <b>Expired</b>
                    <a href="deleteCampaign.php?campaign_id=<?=$campaigns[$i]['campaign_id']?>"> DELETE </a> 
                <?php }} 
                elseif($campaigns[$i]['status']=='Expired') { ?>
                    <b>Expired</b>
                <?php } 
                else {
                if($_SESSION['user']['account_type']=="webmaster") {
                    if($_SESSION['user']['id']==$campaigns[$i]['webmaster_id']) { ?>
                    <b>Hosting</b>
                    <br>
                    <a href="cancelHosting.php?campaign_id=<?=$campaigns[$i]['campaign_id']?>"> Cancel Hosting </a>
                <?php } else { ?>
                    <a href="hostCampaign.php?campaign_id=<?=$campaigns[$i]['campaign_id']?>"> Host Campaign </a>
                <?php }} else {
                    if($_SESSION['user']['id']==$campaigns[$i]['advertiser_id']) { ?>
                    <b>Joined</b>
                    <br>
                    <a href="leaveCampaign.php?campaign_id=<?=$campaigns[$i]['campaign_id']?>"> Leave Campaign </a>
                <?php } else { ?>
                    <a href="joinCampaign.php?campaign_id=<?=$campaigns[$i]['campaign_id']?>"> Join Campaign </a>
                <?php }}} ?>
                </td>  
            </tr>
            <?php } ?>
        </table>
        <div class="action-links">
            <a href="home.php"> Back </a> |
            <a href="../controller/logout.php"> logout </a>
        </div>
    </fieldset>
</body>
</html>
