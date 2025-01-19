<?php
require_once '../model/userModel.php';

function addNewspaper($name, $price) {
    $con = getConnection();
    $sql = "INSERT INTO newspapers (name, price) VALUES ('{$name}', {$price})";
    return mysqli_query($con, $sql);
}

function getAllNewspapers() {
    $con = getConnection();
    $sql = "SELECT * FROM newspapers";
    $result = mysqli_query($con, $sql);

    $newspapers = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($newspapers, $row);
    }

    return $newspapers;
}

function searchNewspapers($query)
{
    $con = getConnection();
    $sql = "SELECT * FROM newspapers WHERE name LIKE '%$query%'";
    $result = mysqli_query($con, $sql);
    $newspapers = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $newspapers[] = $row;
    }
    return $newspapers;
}

function deleteNewspaper($id)
{
    $con = getConnection();
    $sql = "DELETE FROM newspapers WHERE id = $id";
    return mysqli_query($con, $sql);
}

function getNewspaperById($id) {
    $con = getConnection();
    $sql = "SELECT * FROM newspapers WHERE id = {$id}";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

function updateNewspaper($id, $name, $price) {
    $con = getConnection();
    $sql = "UPDATE newspapers SET name = '{$name}', price = {$price} WHERE id = {$id}";
    return mysqli_query($con, $sql);
}
?>
