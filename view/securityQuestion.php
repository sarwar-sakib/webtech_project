<?php 
    session_start();
    require_once('../model/userModel.php');

    if(isset($_REQUEST['submit'])){
        $username = trim($_REQUEST['username']);

        if($username == null){
            echo "Null username";
        }
        elseif(userExists($username)==false){
            echo "Username doesn't exist";
        }
        else{
            $_SESSION['user'] = getUserInfo($username);
        ?>
        
        <html>
        <head>
            <title>Securty Question?</title>
        </head>
        <body align="center">
            <fieldset>
                <legend>Security Question</legend>
                <h2>Security Question for <?=$_SESSION['user']['username']?>: </h2>
                <h3><?=$_SESSION['user']['question']?></h3>
                <form method="post" action="ResetPass.php" enctype=""> 
                    <table border="0" cellspacing="0" align="center">
                        <tr>
                            <td align="left"><b>Answer:</b></td>
                            <td><input type="text" name="answer" value="" /></td>
                        </tr>
                    </table>
                    <br>
                    <input type="submit" name="submit" value="Submit" />
                </form>
                <a href="forgot_password.html"> Cancel </a>
            </fieldset>
        </body>
        </html>

        <?php } 
    }else{
        //echo "invalid request!";
        //header('location: forgot_password.html');
        ?>
        <script>window.location.href = "view/login.html";</script>
    <?php
    }

?>
