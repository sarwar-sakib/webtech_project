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
    
    // Server-side validation
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
    <script src="../asset/submit-feedback.js" defer></script>
</head>
<body>
    <h1>Submit Feedback</h1>
    <form id="feedback-form" method="POST" onsubmit="return false;">
        <textarea name="feedback" id="feedback-input" rows="5" cols="50" placeholder="Write your feedback here..." required onkeyup="return false;"></textarea><br>
        <div id="message-container"></div>
        <input type="submit" value="Submit">
    </form>
    <br>
    <a href="home.php">Back to Dashboard</a>

</body>
</html>
