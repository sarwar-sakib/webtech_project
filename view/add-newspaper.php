<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location: login.html');
}
if ($_SESSION['user']['account_type'] != 'admin') {
    header('location: home.php');
}
?>
<html>
<head>
    <title>Add Newspaper</title>
</head>
<body>
    <h1>Add New Newspaper</h1>
    <form id="addNewspaperForm" onsubmit="return false">
        <label for="name">Newspaper Name:</label>
        <input type="text" id="name" name="name" onkeyup="validateName()" required>
        <p id="nameMessage"></p>
        <br><br>

        <label for="price">Price (in Taka):</label>
        <input type="text" id="price" name="price" step="0.01" onkeyup="validatePrice()" required>
        <p id="priceMessage"></p>
        <br><br>

        <input type="button" value="Add Newspaper" onclick="ajaxAddNewspaper()">
    </form>
    <a href="newspaper-list.php">Back to Newspaper List</a> |
    <a href="home.php">Home</a>
    <script src="../asset/addnewspaper.js"></script>
</body>
</html>
