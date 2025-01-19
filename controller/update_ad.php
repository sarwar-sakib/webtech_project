<?php
session_start();
require_once('../model/adModel.php');

// Ensure user is logged in
if (!isset($_SESSION['user'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adId = $_POST['ad_id'];
    $userId = $_SESSION['user']['id'];
    $newspaper = trim($_POST['newspaper']); // Receive newspaper name
    $price = trim($_POST['price']);         // Receive price
    $publishDate = trim($_POST['publish_date']);
    $adType = trim($_POST['ad_type']);
    $adDescription = trim($_POST['ad_description']);
    $imagePath = null;

    // Validate inputs
    if (empty($newspaper) || empty($price) || empty($publishDate) || empty($adType) || empty($adDescription)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields except the image are required.']);
        exit();
    }

    $wordCount = str_word_count($adDescription);
    if ($wordCount > 40) {
        echo json_encode(['status' => 'error', 'message' => 'Ad description cannot exceed 40 words.']);
        exit();
    }

    // Handle image upload if provided
    if (!empty($_FILES['ad_image']['name'])) {
        $uploadDir = '../asset/';
        $imageName = basename($_FILES['ad_image']['name']);
        $imagePath = $uploadDir . $imageName;

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid image format. Only JPG, JPEG, PNG, and GIF are allowed.']);
            exit();
        }

        if (!move_uploaded_file($_FILES['ad_image']['tmp_name'], $imagePath)) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to upload the image.']);
            exit();
        }
    }

    // Update the ad in the database
    if (updateAd($adId, $userId, $newspaper, $price, $publishDate, $adType, $adDescription, $imagePath)) {
        echo json_encode(['status' => 'success', 'message' => 'Ad updated successfully!', 'redirect' => '../view/ad_list.php']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update the ad.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
