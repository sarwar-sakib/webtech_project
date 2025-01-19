<?php 
    session_start();
    require_once('../model/campaignModel.php');
    if(isset($_REQUEST['submit'])){
            $status = leaveCampaign($_SESSION['campaign_leave_id']);
            if($status){
                header('location: ../view/campaignList.php');
                unset($_SESSION['campaign_leave_id']);
            } else{
                echo "an error occured";
?>
                <a href="../view/campaignList.php"> Return to Campaign List </a>
<?php
                
            }
        }

    else{
        header('location: ../view/signup.html');
    }

?>