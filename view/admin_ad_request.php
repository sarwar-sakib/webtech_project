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

$submittedAds = getAllSubmittedAds();
$username = $_SESSION['user']['username'];
$id = $_SESSION['user']['id'];
$balance = getUserBalance($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Admin - Ad Requests</title>
    
    <script src="../asset/adModeration.js"></script>
    <link rel="stylesheet" href="../asset/adRequest.css">

</head>

<body>
    <main>
        <?php includeTopBar(); ?>

        <h2>Ad Requests</h2>
        <a href="home.php" class="back-button">Back</a>

        <?php if (count($submittedAds) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>User ID</th>
                        <th>Newspaper</th>
                        <th>Price Paid</th>
                        <th>Publish Date</th>
                        <th>Creation Time</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($submittedAds as $ad): ?>
                        <tr>
                            <td><?= $ad['id']; ?></td>
                            <td><?= htmlspecialchars($ad['username']); ?></td>
                            <td><?= $ad['user_id']; ?></td>
                            <td><?= htmlspecialchars($ad['newspaper']); ?></td>
                            <td><?= $ad['price']; ?></td>
                            <td><?= $ad['publish_date']; ?></td>
                            <td><?= $ad['created_at']; ?></td>
                            <td><?= htmlspecialchars($ad['ad_type']); ?></td>
                            <td><?= htmlspecialchars($ad['ad_description']); ?></td>
                            <td><img src="<?= $ad['image_path']; ?>" alt="Ad Image"></td>
                            <td><?= htmlspecialchars($ad['status']); ?></td>
                            <td class="actions">
                                <a href="view_ad.php?id=<?= $ad['id']; ?>" class="update">View</a> <br> <br>
                                <a href="javascript:void(0);" class="pay" onclick="approveAd(<?= $ad['id']; ?>)">Approve</a><br><br>
                                <a href="javascript:void(0);" class="delete" onclick="rejectAd(<?= $ad['id']; ?>)">Reject</a>
                            </td>
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
