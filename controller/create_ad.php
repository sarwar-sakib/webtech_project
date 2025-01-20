<?php
session_start();
require_once('../model/userModel.php');
require_once('../model/adModel.php');

header('Content-Type: application/json');

$response = array('success' => false, 'message' => ''); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION["user"]['id'];
    $newspaper = trim($_REQUEST['newspaper']);
    $price = trim($_REQUEST['price_ui']);
    $publishDate = trim($_REQUEST['publish_date']);
    $adType = trim($_REQUEST['ad_type']);
    $adDescription = trim($_REQUEST['ad_description']);
    $imageFile = $_FILES['ad_image'];

    if (empty($newspaper) || empty($price) || empty($publishDate) || empty($adType) || empty($adDescription)) {
        $response['message'] = "All fields except image are required.";
        echo json_encode($response);
        exit();
    }

    if ($adType == "Classified Display" && empty($imageFile['name'])) {
        $response['message'] = "An image is required for Classified Display ads.";
        echo json_encode($response);
        exit();
    }
    $wordCount = str_word_count($adDescription);
    if ($wordCount > 40) {
        $response['message'] = "Ad description cannot exceed 40 words.";
        echo json_encode($response);
        exit();
    }

    if (!empty($imageFile['name'])) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $imageExtension = strtolower(pathinfo($imageFile['name'], PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $allowedExtensions)) {
            $response['message'] = "Only JPG, JPEG, PNG, or GIF files are allowed.";
            echo json_encode($response);
            exit();
        }

        $uploadDir = '../asset/';
        $uploadFile = $uploadDir . basename($imageFile['name']);

        if (!move_uploaded_file($imageFile['tmp_name'], $uploadFile)) {
            $response['message'] = "Failed to upload the image.";
            echo json_encode($response);
            exit();
        }
    } else {
        $uploadFile = null; 
    }

    $status = createAd($userId, $newspaper, $price, $publishDate, $adType, $adDescription, $uploadFile);

    if ($status) {
        header('Location: ../view/ad_list.php');
        exit();
    } else {
        echo "Failed to create the ad. Please try again.";
    }

    echo json_encode($response);
}
?>
