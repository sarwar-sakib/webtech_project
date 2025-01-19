<?php
session_start();
require_once '../model/userModel.php';
if (!isset($_SESSION['status'])) {
    header('location: login.html');
}
$username = $_SESSION['user']['username'];
$id = $_SESSION['user']['id'];
$balance = getUserBalance($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Balance</title>
    <script src="../asset/addBalance.js"></script>
    <link rel = "stylesheet" href = "../asset/addBalance.css">

</head>
<body>
    <main>

<?php includeTopBar(); ?>

<h2>Add Balance to AdVerse</h2>
<form id="addBalanceForm" onsubmit="event.preventDefault(); ajaxAddBalance();">

    <div>
        <label for="operator">Select Operator:</label>
        <div class="operators">
    <label class="operator">
        <input type="radio" name="operator" value="bkash" onclick="handleOperatorSelection()" required>
        <img src="../asset/images/bKash.png" alt="Bkash"><br>
        Bkash
    </label>

    <label class="operator">
        <input type="radio" name="operator" value="nagad" onclick="handleOperatorSelection()" required>
        <img src="../asset/images/Nagad.png" alt="Nagad"><br>
        Nagad
    </label>

    <label class="operator">
        <input type="radio" name="operator" value="rocket" onclick="handleOperatorSelection()" required>
        <img src="../asset/images/rocket.png" alt="Rocket"><br>
        Rocket
    </label>
    
    <label class="operator">
        <input type="radio" name="operator" value="upay" onclick="handleOperatorSelection()" required>
        <img src="../asset/images/upay.png" alt="Upay"><br>
        Upay
    </label>

   
</div>

    </div>

    <div id="additional-fields" class="hidden">
    <div>
        <label for="mobile_number">Mobile/Account Number:</label>
        <input type="text" id="mobile_number" name="mobile_number" placeholder="e.g., 01XXXXXXXXX" onkeyup="validatePhone()" required>
        <span id="phone_error" class="error"></span>
    </div>

    <div>
        <label for="amount">Enter Amount:</label>
        <input type="number" id="amount" name="amount" placeholder="Minimum amount 100" onkeyup="validateAmount()" required>
        <span id="amount_error" class="error"></span>
    </div>

    <div>
        <label for="password">Enter Password:</label>
        <input type="password" id="password" name="password" placeholder="Password must be 4-5 digits long" onkeyup="validatePassword()" required>
        <span id="password_error" class="error"></span>
        <div class="hint"></div>
    </div>
</div>

<div>
    <input type="submit" value="Submit">
    <a href="home.php">Cancel</a>
</div>


</form>
            </main>

            <?php includeBottomBar(); ?>
</body>
</html>
