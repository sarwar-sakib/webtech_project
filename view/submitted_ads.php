<?php
session_start();
require_once('../model/adModel.php');

if (!isset($_SESSION['status'])) {
    header('location: login.html');
}

$userId = $_SESSION['user']['id'];
$submittedAds = getSubmittedAdsByUserId($userId);
$username = $_SESSION['user']['username'];
$id = $_SESSION['user']['id'];
$balance = getUserBalance($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Submitted Ads</title>
    <link rel = "stylesheet" href = "../asset/submittedAds.css">
    <style>
        
    </style>
</head>

<body>
    <?php includeTopBar($username, $id, $balance); ?>
    <main>
        <h2>Your Submitted Ads</h2>
        <a href="home.php">Back</a>
        <?php if (count($submittedAds) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Newspaper</th>
                        <th>Price</th>
                        <th>Publish Date</th>
                        <th>Submission Time</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($submittedAds as $ad): ?>
                        <tr>
                            <td><?= $ad['id']; ?></td>
                            <td><?= htmlspecialchars($ad['newspaper']); ?></td>
                            <td><?= $ad['price']; ?></td>
                            <td><?= $ad['publish_date']; ?></td>
                            <td><?= $ad['created_at']; ?></td>
                            <td><?= htmlspecialchars($ad['ad_type']); ?></td>
                            <td><?= htmlspecialchars($ad['ad_description']); ?></td>
                            <td><img src="<?= $ad['image_path']; ?>" alt="Ad Image"></td>
                            <td><?= htmlspecialchars($ad['status']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No submitted ads found.</p>
        <?php endif; ?>
    </main>

    <?php includeBottomBar(); ?>
</body>

</html>
