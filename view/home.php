<?php
session_start();
require_once('../model/campaignModel.php');

// Check login status
if (!isset($_SESSION['status'])) {
    header('location: login.html');
    exit();
}

syncStatus();

if ($_SESSION['user']['accepted_terms'] == '0') {
    header('location: acceptTerms.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure body takes up full viewport height */
            background-color: #f5f5f5;
        }

        main {
            flex: 1; /* Pushes the footer down when content is short */
            margin: 20px auto;
            width: 90%;
            max-width: 1200px;
        }

        .dashboard-menu {
            display: flex;
            flex-wrap: wrap; /* Allow wrapping of links */
            gap: 15px; /* Add spacing between links */
            background-color: #0067ce;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            justify-content: center; /* Center align links */
        }

        .dashboard-menu a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            background-color: #004ba0; /* Slightly darker blue for buttons */
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .dashboard-menu a:hover {
            background-color: #ffdd57; /* Soft yellow hover effect */
            color: #333;
        }

        .fieldset {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .legend {
            font-size: 1.5em;
            font-weight: bold;
            color: #333;
            padding-bottom: 10px;
            border-bottom: 2px solid #0067ce;
            margin-bottom: 20px;
        }

        .popularity-bar {
            margin: 20px 0;
        }

        .popularity-bar div {
            margin-bottom: 10px;
        }

        .popularity-bar .bar-container {
            background-color: #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            height: 20px;
        }

        .popularity-bar .bar {
            height: 20px;
            line-height: 20px;
            color: white;
            text-align: center;
            font-size: 0.8em;
        }

        .prothom-alo { background-color: #0067ce; width: 70%; }
        .shomokol { background-color: #28a745; width: 50%; }
        .daily-news { background-color: #ffdd57; width: 90%; }

        .bottom-bar {
            background-color: #0067ce;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 0.9em;
        }

        .bottom-bar a {
            color: white;
            text-decoration: none;
            margin: 0 5px;
        }

        .bottom-bar a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php includeTopBar(); ?>
    <main>
        <div class="dashboard-menu">
            <?php if ($_SESSION['user']['account_type'] == 'admin') { ?>
                <a href="userlist.php">View All Users</a>
                <a href="admin_ad_request.php">Ad Request</a>
                <a href="add-newspaper.php">Add Newspaper</a>
                <a href="newspaper-list.php">Newspapers</a>
                <a href="view-feedback.php">View Feedback</a>
            <?php } elseif ($_SESSION['user']['account_type'] == 'advertiser') { ?>
                <a href="newspaper-list.php">Newspapers</a>
                <a href="../view/ad_list.php">Selected Ads</a>
                <a href="../view/submitted_ads.php">Ad Status</a>
                <a href="../view/payout.php">PayOut</a>
                <a href="../view/submit-feedback.php">Submit Feedback</a>
            <?php } ?>
            <a href="editUser.php?id=<?= $_SESSION['user']['id'] ?>">Edit Profile</a>
            <a href="campaignList.php">View Campaigns</a>
            <a href="transactionList.php">Transactions</a>
            <a href="mailbox.php">Mailbox</a>
            <a href="viewFAQ.php">Support</a>
            <a href="system-settings.php">Settings</a>
            <a href="../controller/logout.php">Logout</a>
        </div>

        <fieldset class="fieldset">
            <legend class="legend">Home</legend>
            <h1>Welcome, <?= htmlspecialchars($_SESSION['user']['username']) ?>!</h1>
            <p><strong>Your Details:</strong></p>
            <table>
                <?php foreach ($_SESSION['user'] as $key => $value) { ?>
                    <tr>
                        <td><strong><?= ucfirst($key) ?>:</strong></td>
                        <td><?= htmlspecialchars($value) ?></td>
                    </tr>
                <?php } ?>
            </table>
        </fieldset>

        <fieldset class="fieldset">
            <legend class="legend">Newspaper Popularity</legend>
            <div class="popularity-bar">
                <div>
                    <strong>Prothom Alo</strong>
                    <div class="bar-container">
                        <div class="bar prothom-alo">70%</div>
                    </div>
                </div>
                <div>
                    <strong>Shomokol</strong>
                    <div class="bar-container">
                        <div class="bar shomokol">50%</div>
                    </div>
                </div>
                <div>
                    <strong>The Daily News</strong>
                    <div class="bar-container">
                        <div class="bar daily-news">90%</div>
                    </div>
                </div>
            </div>
        </fieldset>
    </main>
    <div class="bottom-bar">
        <p>&copy; 2025 AdVerse Studio</p>
        <p><a href="about.html">About Us</a> | <a href="terms.html">Terms & Conditions</a> | <a href="privacy.html">Privacy Policy</a></p>
        <p>contact@adverse.com | Helpline: +880 1712-345678 </p><br>
       
</body>
</html>
