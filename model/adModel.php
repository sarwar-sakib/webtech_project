<?php
    require_once('userModel.php');

    function createAd($userId, $newspaper, $price, $publishDate, $adType, $adDescription, $imagePath) {
        $conn = getConnection();

        $sql = "INSERT INTO ads (user_id, newspaper, price, publish_date, ad_type, ad_description, image_path)
                VALUES ('$userId', '$newspaper', '$price', '$publishDate', '$adType', '$adDescription', '$imagePath')";

        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }

        mysqli_close($conn);
    }


    function getAdsByUserId($userId) {
        $conn = getConnection();

        $sql = "SELECT * FROM ads WHERE user_id = $userId";
        $result = mysqli_query($conn, $sql);

        $ads = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $ads[] = $row;
            }
        }

        mysqli_close($conn);
        return $ads;
    }

    function getAdById($adId) {
        $conn = getConnection(); 
        $sql = "SELECT * FROM ads WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $adId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    function updateAd($id, $userId, $newspaper, $price, $publishDate, $adType, $adDescription, $imagePath) {
        $con = getConnection();
        $imageQuery = $imagePath ? ", image_path='$imagePath'" : "";
        $sql = "UPDATE ads SET newspaper='$newspaper', price='$price', publish_date='$publishDate', 
                ad_type='$adType', ad_description='$adDescription' $imageQuery
                WHERE id='$id' AND user_id='$userId'";
    
        return mysqli_query($con, $sql);
    }



    function moveAdToSubmitted($adId, $userId) {
        $con = getConnection();
    
        try {
            mysqli_begin_transaction($con);
    
            $sqlAd = "SELECT * FROM ads WHERE id = '$adId' AND user_id = '$userId'";
            $resultAd = mysqli_query($con, $sqlAd);
    
            if (!$resultAd || mysqli_num_rows($resultAd) === 0) {
                throw new Exception("Ad not found or you don't have permission.");
            }
    
            $ad = mysqli_fetch_assoc($resultAd);
    
            $sqlUser = "SELECT balance FROM users WHERE id = '$userId'";
            $resultUser = mysqli_query($con, $sqlUser);
    
            if (!$resultUser || mysqli_num_rows($resultUser) === 0) {
                throw new Exception("User not found.");
            }
    
            $user = mysqli_fetch_assoc($resultUser);
    
            if ($user['balance'] < $ad['price']) {
                throw new Exception("Insufficient balance.");
            }
    
            $newBalance = $user['balance'] - $ad['price'];
            $sqlUpdateBalance = "UPDATE users SET balance = '$newBalance' WHERE id = '$userId'";
            if (!mysqli_query($con, $sqlUpdateBalance)) {
                throw new Exception("Failed to update user balance.");
            }
    
            $sqlInsert = "INSERT INTO submitted_ads (user_id, newspaper, price, publish_date, created_at, ad_type, ad_description, image_path, status)
                        VALUES ('$userId', '{$ad['newspaper']}', '{$ad['price']}', '{$ad['publish_date']}', '{$ad['created_at']}', '{$ad['ad_type']}', '{$ad['ad_description']}', '{$ad['image_path']}', 'Pending')";
            if (!mysqli_query($con, $sqlInsert)) {
                throw new Exception("Failed to move ad to submitted_ads.");
            }
    
            $sqlDelete = "DELETE FROM ads WHERE id = '$adId'";
            if (!mysqli_query($con, $sqlDelete)) {
                throw new Exception("Failed to delete ad from ads table.");
            }
    
            mysqli_commit($con);
            return true;
    
        } catch (Exception $e) {
            mysqli_rollback($con);
            error_log("Error in moveAdToSubmitted: " . $e->getMessage());
            return false;
        } finally {
            mysqli_close($con);
        }
    }
    

    function getSubmittedAdsByUserId($userId) {
        $con = getConnection();
        $sql = "SELECT * FROM submitted_ads WHERE user_id = '$userId'";
        $result = mysqli_query($con, $sql);

        $ads = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $ads[] = $row;
            }
        }

        return $ads;
    }

    function getAllSubmittedAds($sortField = 'status', $sortOrder = 'ASC') {
        $con = getConnection();
    
        $validSortFields = ['id', 'user_id', 'newspaper', 'price', 'publish_date', 'created_at', 'ad_type', 'status'];
        if (!in_array($sortField, $validSortFields)) {
            $sortField = 'publish_date'; 
        }
    
        $sortOrder = strtoupper($sortOrder) === 'DESC' ? 'DESC' : 'ASC';
    
        $sql = "SELECT submitted_ads.*, users.username 
                FROM submitted_ads 
                JOIN users ON submitted_ads.user_id = users.id 
                ORDER BY $sortField $sortOrder";
    
        $result = mysqli_query($con, $sql);
    
        $ads = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $ads[] = $row;
            }
        }
    
        return $ads;
    }
    

    function getSubmittedAdById($adId) {
        $con = getConnection();
        $adId = mysqli_real_escape_string($con, $adId);

        $sql = "SELECT submitted_ads.*, users.username 
                FROM submitted_ads 
                JOIN users ON submitted_ads.user_id = users.id 
                WHERE submitted_ads.id = $adId";

        $result = mysqli_query($con, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }

        return null;
    }

    function approveAd($adId, $adminId) {
        $con = getConnection();
    
        $query = "SELECT price FROM submitted_ads WHERE id = $adId";
        $result = $con->query($query);
    
        if ($result && $result->num_rows > 0) {
            $ad = $result->fetch_assoc();
            $price = $ad['price'];
    
            $con->query("UPDATE submitted_ads SET status = 'Approved' WHERE id = $adId");
            $con->query("UPDATE users SET balance = balance + $price WHERE id = $adminId");
    
            return true;
        }
    
        return false;
    }
    

    function getSubmittedAdId($adId) {
        $con = getConnection();
        $sql = "SELECT * FROM submitted_ads WHERE id = $adId";
        $result = mysqli_query($con, $sql);

        return ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result) : null;
    }

    function rejectAd($adId, $adminId) {
        $con = getConnection();
    
        $query = "SELECT * FROM submitted_ads WHERE id = $adId";
        $result = $con->query($query);
    
        if ($result && $result->num_rows > 0) {
            $ad = $result->fetch_assoc();
            $userId = $ad['user_id'];
            $price = $ad['price'];
    
            if ($ad['status'] === 'Rejected') {
                return false;
            }
    
            $con->query("UPDATE submitted_ads SET status = 'Rejected' WHERE id = $adId");
            $con->query("UPDATE users SET balance = balance + $price WHERE id = $userId");
    
            return true;
        }
    
        return false;
    }
    
    function deleteAd($adId) {
        $conn = getConnection();
        $sql = "DELETE FROM ads WHERE id = $adId";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }


    
    function getSubmittedAdsByStatus($status) {
        $con = getConnection();
        $sql = "SELECT * FROM submitted_ads WHERE status = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "s", $status);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $ads = [];
    
        while ($row = mysqli_fetch_assoc($result)) {
            $ads[] = $row;
        }
    
        mysqli_stmt_close($stmt);
        mysqli_close($con);
        return $ads;
    }
    
?>
