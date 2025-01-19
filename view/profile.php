<?php
    session_start();
    require_once('../model/userModel.php');
    // if(!isset($_COOKIE['status'])){
    //     header('location: login.html');  
    // }
    if(!isset($_SESSION['status'])){
        header('location: login.html');  
    }
    // if(isset($_REQUEST['id'])){
    //     echo $_REQUEST['id'];
    // }

    $user = getUser($_REQUEST['id']);
    $_SESSION['update_id'] = $_REQUEST['id'];
?>

<html>
    <main>
    <?php includeTopBar(); ?>
<head>
    <title>Profile Page</title>
</head>
<body>
        <h2>Profile</h2>
        <form method="post" action="../controller/update.php" enctype=""> 
            Name: <?=$user['username']?> <br>
            Email: <?=$user['email']?><br>
           
            Account Type: <?=$user['account_type']?>
            
        </form>
        <br>
        
        <a href="home.php">Back</a> |
        <a href="edit.php?id=<?= $_SESSION["user"]['id'] ?>"> Edit Profile </a>
        
</main>
<?php includeBottomBar(); ?>
        
</body>
</html>