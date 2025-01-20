<?php
session_start();
require_once('../model/newspaperModel.php');

if ($_SESSION['user']['account_type'] == 'admin') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $info = json_decode($_POST['info'], true);

        $name = trim($info['name']);
        $price = trim($info['price']);

        
        if (empty($name)) {
            echo "Name is required.";
            return; 
        }

        if (strlen($name) <= 4) {
            echo "Name must be more than 4 characters.";
            return; 
        }

       
        if (empty($price)) {
            echo "Price is required.";
            return; 
        }

      
        for ($i = 0; $i < strlen($name); $i++) {
            $char = $name[$i];
            if (!(($char >= 'a' && $char <= 'z') || ($char >= 'A' && $char <= 'Z') || $char === ' ')) {
                echo "Invalid name. Only letters and spaces are allowed.";
                return; 
            }
        }

        if (!is_numeric($price)) {
            echo "Invalid price. Enter a numeric value.";
            return; 
        }

        if (floatval($price) < 100) {
            echo "Invalid price. Value must be greater than 99.";
            return;
        }

       
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
