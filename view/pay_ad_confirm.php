<?php
// USER ONLY
session_start();
require_once('../model/adModel.php');

if (!isset($_SESSION['status'])) {
    header('location: login.html');
}

if (!isset($_GET['id'])) {
    die("Ad ID not provided.");
}

$userId = $_SESSION['user']['id'];
$adId = $_GET['id'];

// Fetch the ad details
$ad = getAdById($adId);

if (!$ad || $ad['user_id'] != $userId) {
    die("Ad not found or unauthorized access.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Payment</title>
    <script src="../asset/confirmPay.js"></script>
    <script>
        
    </script>
</head>
<body>
    <main>
    <?php includeTopBar(); ?>
    <h2>Confirm Payment for Ad</h2>
    <p><strong>Newspaper:</strong> <?= htmlspecialchars($ad['newspaper']); ?></p>
    <p><strong>Price:</strong> <?= htmlspecialchars($ad['price']); ?></p>
    <p><strong>Publish Date:</strong> <?= htmlspecialchars($ad['publish_date']); ?></p>
    <p><strong>Type:</strong> <?= htmlspecialchars($ad['ad_type']); ?></p>
    <p><strong>Description:</strong> <?= htmlspecialchars($ad['ad_description']); ?></p>
    <p><strong>Image:</strong> <img src="<?= htmlspecialchars($ad['image_path']); ?>" alt="Ad Image" width="200"></p>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error; ?></p>
    <?php endif; ?>

    <!-- Form for confirming payment -->
    <form id="paymentForm" method="POST" action="javascript:void(0);">
        <input type="hidden" name="ad_id" id="ad_id" value="<?= $adId ?>">

        <button type="button" onclick="confirmSubmission()">Confirm Payment and Submit</button>
        <a href="ad_list.php">Cancel</a>
    </form>
    </main>
    <?php includeBottomBar(); ?>
</body>
</html>
