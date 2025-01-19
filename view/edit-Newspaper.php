<?php
session_start();
require_once('../model/campaignModel.php'); // For includeTopBar and includeBottomBar
require_once('../model/newspaperModel.php');

if (!isset($_SESSION['user']) || $_SESSION['user']['account_type'] != 'admin') {
    header('location: home.php');
    exit();
}

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    header('location: ../view/newspaper-list.php');
    exit();
}

$newspaper = getNewspaperById($id);
$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Newspaper</title>
    <style>
        /* General Page Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #444;
            margin-top: 20px;
        }
        /* Form Styling */
        form {
            width: 50%;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        form label {
            font-size: 14px;
            font-weight: bold;
            color: #555;
        }
        form input[type="text"], 
        form input[type="price"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        form input[type="submit"] {
            padding: 10px 20px;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 14px;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        /* Error Message */
        p#error {
            color: red;
            font-size: 14px;
        }
        /* Back Link */
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
    <script src="../asset/edit-Newspaper.js"></script>
</head>
<body>
    <?php includeTopBar(); ?>

    <main>
        <h1>Edit Newspaper</h1>

        <?php if ($error): ?>
            <p id="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="post" onsubmit="return false">
            <label for="name">Newspaper Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($newspaper['name']) ?>" required onkeyup="validateName()">
            <p id="nameMessage"></p>

            <label for="price">Price (in Taka):</label>
            <input type="text" id="price" name="price" value="<?= htmlspecialchars($newspaper['price']) ?>" step="0.01" required onkeyup="validatePrice()">
            <p id="priceMessage"></p>

            <input type="submit" value="Update Newspaper" onclick="ajaxUpdateNewspaper(<?= $id ?>)">
        </form>

        <a href="../view/newspaper-list.php">Back to Newspaper List</a>
    </main>

    <?php includeBottomBar(); ?>
</body>
</html>
