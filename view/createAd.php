<?php
session_start();
require_once('../model/adModel.php');

// Ensure user is logged in
if (!isset($_SESSION['status'])) {
    header('location: login.html');
}

$username = $_SESSION['user']['username'];
$id = $_SESSION['user']['id'];
$balance = getUserBalance($id);

$selected_newspaper = isset($_GET['newspaper']) ? $_GET['newspaper'] : '';
$selected_price = isset($_GET['price']) ? $_GET['price'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <title>Create Ad</title>
    <script src="../asset/createAd.js"></script>
    <link rel="stylesheet" href="../asset/createAd.css">

</head>
<body>
    <main>
    <?php includeTopBar($username, $id, $balance); ?>


    <h3>Create Ad</h3>

    <form id="adForm" action="../controller/create_ad.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div id="d1">
            <label for="selected_newspaper">Selected Newspaper:</label>
            <input type="text" id="selected_newspaper" name="newspaper" value="<?= htmlspecialchars($selected_newspaper); ?>" readonly>
        </div>

        <div id="d1">
            <label for="price_ui">Price of Ad:</label>
            <input type="hidden" id="price_hidden" name="price_ui" value="<?= htmlspecialchars($selected_price); ?>">
            <input type="text" id="price_ui" value="<?= htmlspecialchars($selected_price); ?>" readonly>
        </div>

        <div id="d1">
            <label for="publish_date">Publication Day:</label>
            <input type="date" id="publish_date" name="publish_date" required onchange="validateDate()">
        </div>

        <div class="ad-type-container">
            <label>Type of Ad:</label><br>
            <div class="radio-group">
                <label class="radio-option">
                    <input type="radio" name="ad_type" value="Classified Text" onclick="toggleImageField()" required>
                    <span>Classified Text</span>
                </label>
                <label class="radio-option">
                    <input type="radio" name="ad_type" value="Classified Display" onclick="toggleImageField()" required>
                    <span>Classified Display</span>
                </label>
            </div>
        </div>

        <div id="d1">
            <label for="ad_description">Ad Description (within 40 words):</label><br>
            <textarea id="ad_description" name="ad_description" maxlength="200"></textarea>
            <span id="description_error" class="error"></span>
        </div>

        <div id="image_upload_field" style="display: none;">
            <label for="ad_image">Ad Image:</label>
            <input type="file" id="ad_image" name="ad_image">
            <span id="image_error" class="error"></span>
        </div>

        <div id="d1">
            <a href="newspaper-list.php">Back</a>
            <input type="submit" name="submit" value="Add to List">
        </div>
    </form>
</main>
    <?php includeBottomBar(); ?>
</body>
</html>
