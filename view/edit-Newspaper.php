<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['account_type'] != 'admin') {
    header('location: home.php');
    exit();
}

require_once('../model/newspaperModel.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    header('location: ../view/newspaper-list.php');
    exit();
}

$newspaper = getNewspaperById($id);
$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;
unset($_SESSION['error']);
?>

<html>
<head>
    <title>Edit Newspaper</title>
</head>
<body>
    <h1>Edit Newspaper</h1>

    <?php if ($error): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="post" onsubmit="return false">
        <label for="name">Newspaper Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($newspaper['name']) ?>" required onkeyup="validateName()"><br><br>
        <p id="nameMessage"></p>

        <label for="price">Price (in Taka):</label>
        <input type="price" id="price" name="price" value="<?= htmlspecialchars($newspaper['price']) ?>" step="0.01" required onkeyup="validatePrice()"><br><br>
        <p id="priceMessage"></p>

        <input type="submit" value="Update Newspaper" onclick="ajaxUpdateNewspaper(<?=$id?>)">
    </form>

    <a href="../view/newspaper-list.php">Back to Newspaper List</a>
    <script src="../asset/edit-Newspaper.js"></script>
</body>
</html>
