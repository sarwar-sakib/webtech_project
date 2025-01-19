<?php
// Start the session and check if the user is logged in and is an admin
session_start();

if (!isset($_SESSION['status']) || $_SESSION['user']['account_type'] != 'admin') {
    header('location: login.html');
    exit();
}

// Include the model to fetch and update terms and conditions
require_once('../model/termsModel.php');

// Fetch current terms and conditions
$current_terms = getTermsAndConditions();

// Handle form submission to update terms
if (isset($_POST['update_terms'])) {
    $new_terms = $_POST['terms_content'];

    // Function to update terms
    if (updateTerms($new_terms)) {
        $_SESSION['message'] = 'Terms updated successfully.';
        // Redirect after update
        echo "<script>
                window.onload = function() {
                    alert('Terms updated successfully.');
                    window.location.href = 'home.php'; // Redirect to home
                }
              </script>";
        exit();
    } else {
        $_SESSION['message'] = 'Error updating terms.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Terms and Conditions</title>
</head>
<body>
    <h1>Change Terms and Conditions</h1>
    
    <?php
    // Display message from session if exists
    if (isset($_SESSION['message'])) {
        echo "<p>{$_SESSION['message']}</p>";
        unset($_SESSION['message']);
    }
    ?>

    <form method="POST">
        <textarea name="terms_content" rows="10" cols="50"><?= htmlspecialchars($current_terms) ?></textarea><br><br>
        <input type="submit" name="update_terms" value="Update Terms and Conditions">
    </form>

    <br>
    <a href="home.php">Back to Home</a>
</body>
</html>
