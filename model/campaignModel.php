<?php

require_once '../model/userModel.php';


    function campaignExists($campaign_id){
        $con = getConnection();
        $sql = "select * from campaigns where campaign_id='{$campaign_id}'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);

        if($count==0){
            return false;
        }else{
            return true;
        }
    }

    function addCampaign($campaign_name, $campaign_domain, $budget, $expire_date){
        $con = getConnection();
        $sql = "insert into campaigns (campaign_id, campaign_name, campaign_domain, budget, expire_date) VALUES('', '{$campaign_name}', '{$campaign_domain}', '{$budget}', '{$expire_date}')";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function updateCampaign($campaign_id, $campaign_name, $campaign_domain, $website_url, $budget, $expire_date){
        $con = getConnection();
        $sql = "update campaigns SET campaign_name='$campaign_name', campaign_domain='$campaign_domain', website_url='$website_url', budget='{$budget}', expire_date='{$expire_date}' where campaign_id='$campaign_id'";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function hostCampaign($campaign_id, $webmaster_id, $website_url){
        $con = getConnection();
        $campaign = getCampaign($campaign_id);
        if(isset($campaign['advertiser_id'])){
            $set = "Ongoing";
        }
        else{
            $set = "Waiting";
        }
        $sql = "update campaigns SET webmaster_id='$webmaster_id', website_url='$website_url', status='{$set}' where campaign_id='$campaign_id'";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function cancelHosting($campaign_id){
        $con = getConnection();
        $campaign = getCampaign($campaign_id);
        if(isset($campaign['advertiser_id'])){
            $set = "Unhosted";
        }
        else{
            $set = "Pending";
        }
        $sql = "update campaigns SET webmaster_id=NULL, website_url=NULL, status='$set' where campaign_id='$campaign_id'";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function joinCampaign($campaign_id, $advertising_brand, $advertiser_id){
        $con = getConnection();
        $campaign = getCampaign($campaign_id);
        if(isset($campaign['webmaster_id'])){
            $set = "Ongoing";
        }
        else{
            $set = "Unhosted";
        }
        $sql = "update campaigns SET advertising_brand='$advertising_brand', advertiser_id='$advertiser_id', status='{$set}' where campaign_id='$campaign_id'";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function leaveCampaign($campaign_id){
        $con = getConnection();
        $campaign = getCampaign($campaign_id);
        if(isset($campaign['webmaster_id'])){
            $set = "Waiting";
        }
        else{
            $set = "Pending";
        }
        $sql = "update campaigns SET advertising_brand=NULL, advertiser_id=NULL, status='{$set}' where campaign_id='$campaign_id'";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function deleteCampaign($campaign_id){
        $con = getConnection();
        $sql = "DELETE FROM campaigns where campaign_id=$campaign_id";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function getCampaign($campaign_id){
        $con = getConnection();
        $sql = "select * from campaigns where campaign_id='{$campaign_id}'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    function getCampaignInfo($campaign_id){
        $con = getConnection();
        $sql = "select * from campaigns where campaign_id='{$campaign_id}'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    function getUserCampaign($id){
        $con = getConnection();
        $sql = "select * from campaigns where webmaster_id=$id or advertiser_id=$id";
        $result = mysqli_query($con, $sql);
        $campaigns = [];

        while($row = mysqli_fetch_assoc($result)){
            //print_r($row);
            //echo "<br>";
            array_push($campaigns, $row);
        }
        
        return $campaigns;
    }

    function getAllCampaign(){
        $con = getConnection();
        $sql = "select * from campaigns";
        $result = mysqli_query($con, $sql);

        $campaigns = [];

        while($row = mysqli_fetch_assoc($result)){
            //print_r($row);
            //echo "<br>";
            array_push($campaigns, $row);
        }
        
        return $campaigns;
    }

    function syncStatus(){
        $con = getConnection();
        $campaigns = getAllCampaign();
    
        foreach ($campaigns as $campaign) {
            $sql = ""; 
    
            $expire_date = $campaign['expire_date'];
            $current_date = date("Y-m-d");
    
            if ($campaign['status'] == "Ongoing" && $current_date > $expire_date) {
                $sql = "UPDATE campaigns SET status='Completed' WHERE campaign_id='{$campaign['campaign_id']}'";
            } elseif ($campaign['status'] != "Ongoing" && $current_date > $expire_date) {
                $sql = "UPDATE campaigns SET status='Expired' WHERE campaign_id='{$campaign['campaign_id']}'";
            }
    
            if (!empty($sql)) {
                mysqli_query($con, $sql);
            }
        }
    }    

?>