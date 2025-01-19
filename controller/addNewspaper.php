<?php
session_start();
require_once('../model/newspaperModel.php');

if ($_SESSION['user']['account_type'] == 'admin') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $info = json_decode($_POST['info'], true);

        $name = trim($info['name']);
        $price = trim($info['price']);

        // Server-side validation
        if (empty($name) || empty($price)) {
            echo "All fields are required.";
            exit;
        }

        // Validate name: allow only letters and spaces
        foreach (str_split($name) as $char) {
            if (is_numeric($char)) {
                echo "Invalid name. Numbers are not allowed.";
                exit;
            }
        }

        // Validate price: must be numeric and greater than 0
        if (!is_numeric($price) || floatval($price) <= 0) {
            echo "Invalid price. Enter a number greater than 0.";
            exit;
        }

        // Add newspaper to the database
        $status = addNewspaper($name, $price);
        if ($status) {
            echo "success";
        } else {
            echo "Failed to add newspaper!";
        }
    }
} else {
    header('Location: ../view/home.php');
    exit;
}
?>
