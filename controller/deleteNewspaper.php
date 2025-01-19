<?php
session_start();

if ($_SESSION['user']['account_type'] == 'admin') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
        $id = trim($_POST['id']);

        if (!empty($id)) {
            require_once('../model/newspaperModel.php');
            if (deleteNewspaper($id)) {
                echo "success";
            } else {
                echo "Failed to delete newspaper!";
            }
        } else {
            echo "Invalid ID.";
        }
    }
} else {
    echo "Unauthorized action.";
}
?>
