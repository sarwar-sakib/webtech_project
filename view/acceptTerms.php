<?php

session_start();

if (!isset($_SESSION['status'])) {
    header('location: login.html');
    exit();
}

require_once('../model/termsModel.php');

function acceptUserTerms($user_id) {
    $con = getConnection();
    $sql = "UPDATE users SET accepted_terms = 1 WHERE id = $user_id";
    return mysqli_query($con, $sql);
}

function getUserInfo($username){
    $con = getConnection();
    $sql = "select * from users where username='{$username}'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row;
}

if (isset($_POST['accept_terms'])) {
    $user_id = $_SESSION['user']['id'];
    if (acceptUserTerms($user_id)) {
        $_SESSION['user'] = getUserInfo($_SESSION['user']['username']);
        header('Location: accepted.html');
        exit();
    } else {
        echo "Error accepting terms.";
    }
}

$current_terms = getTermsAndConditions();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Accept Terms and Conditions</title>
</head>
<body>
    <h1>Terms and Conditions</h1>
    <div style="border: 1px solid #ccc; padding: 10px; max-height: 300px; overflow-y: auto;">
        <p><?= nl2br($current_terms) ?></p>
    </div>
    
    <form method="POST">
        <p>By accepting, you agree to the terms and conditions of our platform.</p>
        <input type="checkbox" id="agree" name="agree" value="yes" required>
        <label for="agree">I agree to the Terms and Conditions</label><br><br>
        <button type="submit" name="accept_terms">Accept Terms</button>
    </form>
</body>
</html>
