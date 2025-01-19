<?php
// USER ONLY
session_start();
require_once('../model/adModel.php');

if (!isset($_SESSION['status'])) {
    header('location: login.html');
}

// Ensure advertiser access
if ($_SESSION['user']['account_type'] !== 'advertiser') {
    header('Location: ../view/home.php');
    exit;
}

if (!isset($_GET['id'])) {
    echo "Ad ID not provided.";
    exit();
}

$adId = $_GET['id'];
$ad = getAdById($adId);
if (!$ad) {
    echo "Ad not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Update Ad</title>
    <link rel="stylesheet" href="../asset/updateAd.css">
    <script src="../asset/updateAd.js"></script>

</head>
<body>
    <main>
        <?php includeTopBar(); ?>
        <h3>Update Ad</h3>
        <form id="updateAdForm" enctype="multipart/form-data">
            <input type="hidden" name="ad_id" id="ad_id" value="<?= htmlspecialchars($ad['id']) ?>">

        <div>
            <label for="newspaper">Newspaper:</label>
            <input type="text" id="newspaper" name="newspaper" value="<?= htmlspecialchars($ad['newspaper']) ?>" readonly>
            <input type="hidden" id="hidden_newspaper" name="hidden_newspaper" value="<?= htmlspecialchars($ad['newspaper']) ?>">
            <span id="error-newspaper" class="error-message"></span>
        </div>

        <div>
            <label for="price">Price of Ad:</label>
            <input type="text" id="price" name="price" value="<?= htmlspecialchars($ad['price']) ?>" readonly>
            <input type="hidden" id="hidden_price" name="hidden_price" value="<?= htmlspecialchars($ad['price']) ?>">
            <span id="error-price" class="error-message"></span>
        </div>

        <div>
            <label for="publish_date">Publication Day:</label>
            <input type="date" id="publish_date" name="publish_date" value="<?= htmlspecialchars($ad['publish_date']) ?>" required>
            <span id="error-publish_date" class="error-message"></span>
        </div>

        <div>
            <label for="ad_type">Type of Ad:</label>
            <select id="ad_type" name="ad_type" required>
                <option value="Classified" <?= $ad['ad_type'] == 'Classified' ? 'selected' : '' ?>>Classified</option>
                <option value="Display" <?= $ad['ad_type'] == 'Display' ? 'selected' : '' ?>>Display</option>
            </select>
            <span id="error-ad_type" class="error-message"></span>
        </div>

        <div>
            <label for="ad_description">Ad Description (within 40 words):</label><br>
            <textarea id="ad_description" name="ad_description" maxlength="200" required><?= htmlspecialchars($ad['ad_description']); ?></textarea>
            <span id="error-ad_description" class="error-message"></span>
        </div>

        <div>
            <label for="ad_image">Ad Image:</label>
            <input type="file" id="ad_image" name="ad_image">
            <span id="error-ad_image" class="error-message"></span>
        </div>

        <div>
            <button type="button" onclick="updateAd()">Update</button>
            <a href="../view/ad_list.php">Cancel</a>
        </div>
        </form>
    </main>

    <?php includeBottomBar(); ?>
</body>
</html>
