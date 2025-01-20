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
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            text-align: center;
            padding: 20px;
        }
        h1 {
            color: #007bff;
            margin-bottom: 20px;
        }
        p {
            color: #28a745;
            font-weight: bold;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
            text-align: left;
        }
        textarea {
            width: 100%;
            max-width: 500px;
            height: 200px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: none;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
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

