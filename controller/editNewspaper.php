<?php
session_start();
require_once('../model/newspaperModel.php');

// Ensure the user is an admin
if ($_SESSION['user']['account_type'] != 'admin') {
    header('location: home.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $info = json_decode($_REQUEST['info'], true);

    $id = trim($info['id']);
    $name = trim($info['name']);
    $price = trim($info['price']);

    $newspaper = getNewspaperById($id);

    // Validate the input data
    if (!empty($name) && is_numeric($price)) {
        // Update the newspaper in the database
        $status = updateNewspaper($id, $name, $price);

        // Check if the update was successful
        if ($status) {
            echo "success";
            exit();
        } else {
            $_SESSION['error'] = "Failed to update newspaper!";
            echo "failed";
            exit();
        }
    } else {
        $_SESSION['error'] = "Please fill all fields correctly.";
        header("location: edit-Newspaper.php?id=$id");
        exit();
    }
} else {
    header('location: ../view/newspaper-list.php');
    exit();
}

// If the form is not submitted, display the form with the newspaper data
require_once('../view/edit-Newspaper.php');
?>
