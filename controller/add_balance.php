<?php
session_start();
require_once('../model/userModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode JSON data sent via AJAX
    $data = json_decode($_POST['info'], true);
    $operator = $data['operator'] ?? null;
    $mobileNumber = $data['mobile_number'] ?? null;
    $amount = (int) ($data['amount'] ?? 0);
    $userId = $_SESSION['user']['id'];

    // Input Validation
    if (empty($operator) || empty($mobileNumber) || $amount < 99) {
        echo "Invalid input. Please check your data.";
        exit();
    }

    // Update Balance
    if (addBalance($userId, $amount)) {
        echo "success";
    } else {
        echo "Failed to update balance. Please try again.";
    }
} else {
    echo "Invalid request method.";
    exit();
}
?>
