<?php

function getConnection() {
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "testing_project";

    $con = mysqli_connect($host, $user, $password, $database);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $con;
}

function getTermsAndConditions() {
    $con = getConnection();
    $sql = "SELECT content FROM terms_conditions WHERE id = 1";  
    $result = mysqli_query($con, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['content'];
    }
    return '';  
}

function updateTerms($new_terms) {
    $con = getConnection();
    $sql = "UPDATE terms_conditions SET content = '$new_terms' WHERE id = 1"; 
    return mysqli_query($con, $sql);
}
?>
