<?php

    function getConnection(){
        $con = mysqli_connect('127.0.0.1', 'root', '', 'testing_project');
        return $con;
    }

    function addFAQ($faq_topic, $faq_question, $faq_answer){
        $con = getConnection();
        $sql = "insert into faqs VALUES('', '$faq_topic', '$faq_question', '$faq_answer')";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function updateFAQ($faq_id, $faq_topic, $faq_question, $faq_answer){
        $con = getConnection();
        $sql = "update faqs SET faq_topic='$faq_topic', faq_question='$faq_question', faq_answer='$faq_answer' where faq_id='$faq_id'";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function deleteFAQ($id){
        $con = getConnection();
        $sql = "DELETE FROM faqs where faq_id=$id";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function getFAQ($id){
        $con = getConnection();
        $sql = "select * from faqs where faq_id='{$id}'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    function getAllFAQ(){
        $con = getConnection();
        $sql = "select * from faqs";
        $result = mysqli_query($con, $sql);

        $users = [];

        while($row = mysqli_fetch_assoc($result)){
            //print_r($row);
            //echo "<br>";
            array_push($users, $row);
        }
        
        return $users;
    }

?>