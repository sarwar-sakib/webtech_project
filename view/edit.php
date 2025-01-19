<?php
session_start();
require_once('../model/userModel.php');

if (!isset($_SESSION['status'])) {
    header('location: login.html');
}

$user = getUser($_REQUEST['id']);
$_SESSION['update_id'] = $_REQUEST['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <main>
<?php includeTopBar(); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile</title>
    
    <script src="../asset/editProfile.js"></script>
</head>
<body>
    <h2>Edit User Profile</h2>
    <form id="updateForm" onsubmit="submitForm(event)">
        <!-- Username -->
        Name: 
        <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" onkeyup="validateUsername()" />
        <span id="usernameError" style="color: red;"></span><br>

        <!-- Email -->
        Email: 
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" onkeyup="validateEmail()" />
        <span id="emailError" style="color: red;"></span><br>

        <!-- Password -->
        Password: 
        <input type="password" id="password" name="password" value="<?= htmlspecialchars($user['password']) ?>" onkeyup="validatePassword()" />
        <span id="passwordError" style="color: red;"></span><br>

        <!-- Submit button -->
        <button type="submit">Submit</button>
    </form>
    <br>
    <a href="profile.php?id=<?= $_SESSION["user"]['id'] ?>">Cancel</a>
    </main>
    <?php includeBottomBar(); ?>
</body>
</html>
