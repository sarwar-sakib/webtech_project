<?php
session_start();
require_once('../model/campaignModel.php');
if (!isset($_SESSION['status'])) {
    header('location: login.html');
}
if ($_SESSION['user']['account_type'] != 'admin') {
    header('location: home.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Newspaper</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f5f5f5;
        }

        main {
            flex: 1;
            margin: 20px auto;
            width: 90%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="button"] {
            font-size: 1em;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        input[type="button"] {
            background-color: #0067ce;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        input[type="button"]:hover {
            background-color: #004ba0;
        }

        p {
            color: red;
            font-size: 0.9em;
            margin-bottom: 10px;
        }

        a {
            color: #0067ce;
            text-decoration: none;
            margin-right: 10px;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .link-container {
            text-align: center;
            margin-top: 10px;
        }

        .bottom-bar {
            background-color: #0067ce;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 0.9em;
        }

        .bottom-bar a {
            color: white;
            text-decoration: none;
            margin: 0 5px;
        }

        .bottom-bar a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php includeTopBar(); ?>
    <main>
        <h1>Add New Newspaper</h1>
        <form id="addNewspaperForm" onsubmit="return false">
            <label for="name">Newspaper Name:</label>
            <input type="text" id="name" name="name" onkeyup="validateName()" required>
            <p id="nameMessage"></p>

            <label for="price">Price (in Taka):</label>
            <input type="text" id="price" name="price" step="0.01" onkeyup="validatePrice()" required>
            <p id="priceMessage"></p>

            <input type="button" value="Add Newspaper" onclick="ajaxAddNewspaper()">
        </form>
        <div class="link-container">
            <a href="newspaper-list.php">Back to Newspaper List</a> |
            <a href="home.php">Home</a>
        </div>
    </main>
    <div class="bottom-bar">
        <p>&copy; 2025 AdVerse Studio</p>
        <p><a href="about.html">About Us</a> | <a href="terms.html">Terms</a> | <a href="privacy.html">Privacy</a></p>
    </div>
    <script src="../asset/addnewspaper.js"></script>
</body>
</html>
