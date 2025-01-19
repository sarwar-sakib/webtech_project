<?php
session_start();
require_once('../model/userModel.php');

header('Content-Type: application/json'); // Ensure JSON response format

if (!isset($_SESSION['status'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_REQUEST['info'])) {
        $info = $_REQUEST['info'];
        $data = json_decode($info, true);

        if (
            isset($data['username'], $data['email'], $data['password'], $data['account_type'], $data['question'], $data['answer'])
        ) {
            $username = trim($data['username']);
            $email = trim($data['email']);
            $password = trim($data['password']);
            $account_type = trim($data['account_type']);
            $question = trim($data['question']);
            $answer = trim($data['answer']);

            if (empty($username) || empty($email) || empty($password) || empty($account_type) || empty($question) || empty($answer)) {
                echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
                exit();
            }

            // Call the addUser function
            if (addNewUser($username, $email, $password, $account_type, $question, $answer)) {
                echo json_encode(['status' => 'success', 'message' => 'User added successfully!']);
                exit();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to add user. Please try again.']);
                exit();
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid or incomplete data provided.']);
            exit();
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No data received.']);
        exit();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit();
}
?>
