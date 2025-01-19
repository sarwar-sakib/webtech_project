<?php
session_start();

if (!isset($_SESSION['status'])) {
    header('location: login.html');
    exit;
}

$username = $_SESSION['user']['username'];
$account_type = $_SESSION['user']['account_type'];
$con = mysqli_connect('127.0.0.1', 'root', '', 'testing_project');

date_default_timezone_set('Asia/Dhaka');

// Fetch system settings
$sql = "SELECT * FROM system_settings WHERE username = '{$username}'";
$result = mysqli_query($con, $sql);
$settings = mysqli_fetch_assoc($result);

if (!$settings) {
    $sql = "INSERT INTO system_settings (username, time_format) VALUES ('{$username}', '24h')";
    mysqli_query($con, $sql);
    $settings = ['time_format' => '24h'];
}

$current_time = ($settings['time_format'] == '12h') 
    ? date('h:i A') 
    : date('H:i');

// Fetch notifications
if ($account_type == 'admin') {
    $sql = "SELECT * FROM notifications WHERE username IS NULL ORDER BY created_at DESC";
    $notifications = mysqli_query($con, $sql);
} elseif ($account_type == 'advertiser') {
    // Default notifications for advertiser
    $notifications = [
        ['message' => 'Submit your feedback to help us improve.', 'created_at' => date('Y-m-d H:i:s')],
        ['message' => 'Newspapers are now available for campaign creation.', 'created_at' => date('Y-m-d H:i:s')],
        ['message' => 'Check out our updated terms and conditions.', 'created_at' => date('Y-m-d H:i:s')],
    ];
}

// Handle AJAX request to update time format
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_time_format') {
    $new_format = $_POST['time_format'];
    $sql = "UPDATE system_settings SET time_format = '{$new_format}' WHERE username = '{$username}'";
    if (mysqli_query($con, $sql)) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Time format updated successfully!',
            'current_time' => ($new_format === '12h') ? date('h:i A') : date('H:i'),
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update time format.']);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>System Settings</title>
    <script src="../asset/system-settings.js" defer></script>
</head>
<body>
    <h1>System Settings</h1>

    <h2>Time Format</h2>
    <form id="time-format-form">
        <select name="time_format" id="time-format">
            <option value="12h" <?= $settings['time_format'] == '12h' ? 'selected' : '' ?>>12-hour</option>
            <option value="24h" <?= $settings['time_format'] == '24h' ? 'selected' : '' ?>>24-hour</option>
        </select>
        <button type="submit">Update</button>
    </form>

    <h3>Current Time: <span id="current-time"><?= $current_time ?></span></h3>
    <p id="message" style="color: green; display: none;"></p>

    <h2>Notifications</h2>
    <ul>
        <?php if ($account_type == 'admin') { ?>
            <?php while ($notification = mysqli_fetch_assoc($notifications)) { ?>
                <li><?= htmlspecialchars($notification['message']) ?> (<?= $notification['created_at'] ?>)</li>
            <?php } ?>
        <?php } elseif ($account_type == 'advertiser') { ?>
            <?php foreach ($notifications as $notification) { ?>
                <li><?= htmlspecialchars($notification['message']) ?> (<?= $notification['created_at'] ?>)</li>
            <?php } ?>
        <?php } ?>
    </ul>

    <br>
    <a href="home.php">Back to Dashboard</a>
</body>
</html>
