<?php
session_start();
require_once('../model/adModel.php');

if (!isset($_SESSION['status'])) {
    header('location: login.html');
}

$userId = $_SESSION['user']['id'];
$ads = getAdsByUserId($userId);
$username = $_SESSION['user']['username'];
$balance = getUserBalance($userId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ad List</title>
    
    <script src="../asset/deleteAd.js"></script>
    <link rel = "stylesheet" href = "../asset/adList.css">
    <script>
        

    </script>
    <style>
        
    </style>
</head>

<body>
   
        <?php includeTopBar($username, $userId, $balance); ?>
   

    <main>
        <h2>Your Ads (Cart)</h2>
        <a href="home.php">Back</a>

        <?php if (count($ads) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Newspaper</th>
                        <th>Price</th>
                        <th>Publish Date</th>
                        <th>Creation Time</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ads as $ad): ?>
                        <tr>
                            <td><?= $ad['id']; ?></td>
                            <td><?= htmlspecialchars($ad['newspaper']); ?></td>
                            <td><?= $ad['price']; ?></td>
                            <td><?= $ad['publish_date']; ?></td>
                            <td><?= $ad['created_at']; ?></td>
                            <td><?= htmlspecialchars($ad['ad_type']); ?></td>
                            <td><?= htmlspecialchars($ad['ad_description']); ?></td>
                            <td>
                                <img src="<?= $ad['image_path']; ?>" alt="Ad Image">
                            </td>
                            <td class="actions">
                            <a href="update_ad.php?id=<?= htmlspecialchars($ad['id']); ?>" class="update">Update</a>
                            <a href="javascript:void(0);" class="delete" onclick="deleteAd(<?= $ad['id'] ?>)">Delete</a> <br><br>

                                <a href="pay_ad_confirm.php?id=<?= $ad['id']; ?>" class="pay">Pay and Submit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No ads found.</p>
        <?php endif; ?>
    </main>

    <div id="bottom-bar">
        <?php includeBottomBar(); ?>
    </div>
</body>

</html>
