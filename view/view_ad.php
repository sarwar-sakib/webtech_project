<?php
//ADMIN ONLY
    session_start();
    require_once('../model/adModel.php');

    if (!isset($_SESSION['status'])) {
        header('location: login.html');
    }
    // Ensure admin access
    if ($_SESSION['user']['account_type'] !== 'admin') {
        header('Location: ../view/home.php');
        exit;
    }

    if (!isset($_GET['id'])) {
        echo "Ad ID not provided.";
        exit;
    }

    $adId = intval($_GET['id']);
    $ad = getSubmittedAdById($adId);

    if (!$ad) {
        echo "Ad not found.";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Ad Details</title>
</head>

<body>
<h2>Ad Details</h2>
<a href="admin_ad_request.php">Back</a>

<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>Ad ID</th>
        <td><?= htmlspecialchars($ad['id']); ?></td>
    </tr>
    <tr>
        <th>User Name</th>
        <td><?= htmlspecialchars($ad['username']); ?></td>
    </tr>
    <tr>
        <th>Newspaper</th>
        <td><?= htmlspecialchars($ad['newspaper']); ?></td>
    </tr>
    <tr>
        <th>Price</th>
        <td><?= htmlspecialchars($ad['price']); ?></td>
    </tr>
    <tr>
        <th>Publish Date</th>
        <td><?= htmlspecialchars($ad['publish_date']); ?></td>
    </tr>
    <tr>
        <th>Created At</th>
        <td><?= htmlspecialchars($ad['created_at']); ?></td>
    </tr>
    <tr>
        <th>Type</th>
        <td><?= htmlspecialchars($ad['ad_type']); ?></td>
    </tr>
    <tr>
        <th>Description</th>
        <td><?= htmlspecialchars($ad['ad_description']); ?></td>
    </tr>
    <tr>
        <th>Image</th>
        <td><img src="<?= htmlspecialchars($ad['image_path']); ?>" alt="Ad Image" width="300"></td>
    </tr>
    <tr>
        <th>Status</th>
        <td><?= htmlspecialchars($ad['status']); ?></td>
    </tr>
</table>

</body>
</html>
