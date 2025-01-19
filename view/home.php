<?php
    session_start();
    require_once('../model/campaignModel.php');
    
    // if(!isset($_COOKIE['status'])){
    //     header('location: login.html');  
    // }
    if(!isset($_SESSION['status'])){
        header('location: login.html');  
    }
    
    syncStatus();

    if($_SESSION['user']['accepted_terms'] == '0'){
        header('location: acceptTerms.php');
    }
    
?>

<html lang="en">
<head>
    <title>Home</title>
</head>
<main>
<?php includeTopBar(); ?>
<body align="center">
    <fieldset>
        <legend>
            <b>
                Home
            </b>
        </legend>
        <h1>Welcome Home! <?=$_SESSION['user']['username']?></h1>
        <table align="center">
            <tr>
                <td align="left">
                    <p>
                        <?php 
                        foreach ($_SESSION['user'] as $key => $value) { ?>
                            <strong><?= ucfirst($key) ?>:</strong> <?= htmlspecialchars($value) ?> <br>
                        <?php } ?>
                    </p>
                </td>
            </tr>
        </table>
        <br>
        <table align="center">
        <tr>
    <td>
        <?php 
        // Admin-specific links
        if ($_SESSION['user']['account_type'] == 'admin') { ?>
            <a href="userlist.php">View All Users</a> |
            <a href="admin_ad_request.php">Ad Request</a> |
            <a href="add-newspaper.php">Ad Newspaper</a> |
            <a href="newspaper-list.php">Newspapers</a> |
            <a href="view-feedback.php">View Feedback</a> |
            

        <?php } ?>

        <?php 
        // Advertiser-specific links
        if ($_SESSION['user']['account_type'] == 'advertiser') { ?>
            <a href="newspaper-list.php">Newspapers</a> |
            <a href="../view/ad_list.php">Selected Ads</a> |
            <a href="../view/submitted_ads.php">Ad Status</a> |
            <a href="../view/payout.php">PayOut</a> |
            <a href="../view/submit-feedback.php">Submit Feedback</a> |
        <?php } ?>

        <?php 
        // Webmaster-specific links
        if ($_SESSION['user']['account_type'] == 'webmaster') { ?>
           
        <?php } ?>

        <!-- Common link for all users -->
        <a href="editUser.php?id=<?=$_SESSION['user']['id']?>">Edit Own Profile</a> |
        <a href="campaignList.php">View Campaigns</a> |
            <a href="transactionList.php">View Transactions</a> |
            <a href="mailbox.php">Mailbox</a> |
            <a href="viewFAQ.php">Support</a> |
    </td>
</tr>

            <tr>
                <td align="center">
                    <?php $_SESSION['requested_from'] = basename($_SERVER['PHP_SELF']); ?> 
                    <a href="system-settings.php">System Settings</a> |
                    <a href="../controller/logout.php">Logout</a>
                </td>
            </tr>
        </table>
    </fieldset>

    </main>
    <?php includeBottomBar(); ?>
</body>
</html>
