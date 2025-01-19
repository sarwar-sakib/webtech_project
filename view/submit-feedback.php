<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['user']['account_type'] != 'advertiser') {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['user']['username'];
    $feedback = trim($_POST['feedback']);
    
    if (empty($feedback)) {
        echo json_encode(['status' => 'error', 'message' => 'Feedback cannot be empty.']);
        exit;
    }
    if (strlen($feedback) < 10) {
        echo json_encode(['status' => 'error', 'message' => 'Feedback must be at least 10 characters long.']);
        exit;
    }
    if (strlen($feedback) > 500) {
        echo json_encode(['status' => 'error', 'message' => 'Feedback cannot exceed 500 characters.']);
        exit;
    }

    $con = mysqli_connect('127.0.0.1', 'root', '', 'testing_project');
    if (!$con) {
        echo json_encode(['status' => 'error', 'message' => 'Database connection failed.']);
        exit;
    }

    $feedback = mysqli_real_escape_string($con, $feedback);
    $sql = "INSERT INTO feedback (username, feedback) VALUES ('{$username}', '{$feedback}')";
    
    if (mysqli_query($con, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Feedback submitted successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to submit feedback.']);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            background-color: rgb(0, 123, 255);
            color: white;
            padding: 15px 0;
            margin: 0;
        }

        form {
            width: 80%;
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        textarea {
            width: 100%;
            height: 150px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
        }

        textarea:focus {
            border-color: rgb(0, 123, 255);
            outline: none;
            box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
        }

        input[type="submit"] {
            background-color: rgb(0, 123, 255);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            display: block;
            margin: 10px auto;
        }

        input[type="submit"]:hover {
            background-color: rgb(0, 100, 210);
        }

        #message-container {
            text-align: center;
            margin-bottom: 10px;
            font-size: 14px;
            color: red;
        }

        a {
            display: block;
            text-align: center;
            text-decoration: none;
            color: rgb(0, 123, 255);
            font-weight: bold;
            margin-top: 20px;
        }

        a:hover {
            color: rgb(0, 100, 210);
        }
    </style>
    <script src="../asset/submit-feedback.js" defer></script>
</head>
<body>
    <h1>Submit Feedback</h1>
    <form id="feedback-form" method="POST" onsubmit="return false;">
        <textarea name="feedback" id="feedback-input" placeholder="Write your feedback here..." required></textarea><br>
        <div id="message-container"></div>
        <input type="submit" value="Submit">
    </form>
    <a href="home.php">Back to Dashboard</a>
</body>
</html>
