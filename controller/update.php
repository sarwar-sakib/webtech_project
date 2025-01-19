<?php
session_start();
require_once('../model/userModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($_SESSION['update_id']) || empty($input['username']) || empty($input['email']) || empty($input['password'])) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input or session expired.']);
        exit;
    }

    $updateId = $_SESSION['update_id'];
    $username = trim($input['username']);
    $email = trim($input['email']);
    $password = trim($input['password']);
    $accountType = 'advertiser'; // Default account type

    // Update user in the database
    $status = updateUser($updateId, $username, $email, $password, $accountType);

    if ($status) {
        echo json_encode(['status' => 'success', 'userId' => $_SESSION['user']['id']]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update user.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
