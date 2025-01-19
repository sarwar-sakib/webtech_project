<?php 
    session_start();
    require_once('../model/userModel.php');

    if(isset($_REQUEST['submit'])){
        $answer = trim($_REQUEST['answer']);

        if($answer == null){
            echo "Null username";
        }
        elseif($answer != $_SESSION['user']['answer']){
            echo "Wrong answer";
        }
        else{
        ?>
        
        <html>
        <head>
            <title>Reset Password</title>
        </head>
        <body align="center">
            <fieldset>
                <legend>Reset Password</legend>
                <h2>Reset password for <?=$_SESSION['user']['username']?></h2>
                <form method="post" action="../controller/confirmResetPass.php" enctype=""> 
                    <table border="0" cellspacing="0" align="center">
                        <tr>
                            <td align="left"><b>New Password</b></td>
                            <td><input type="password" name="password" value="" placeholder="Minimum length=4"/> </td>
                        </tr>
                        <tr>
                            <td align="left"><b>Confirm Password</b></td>
                            <td><input type="password" name="confirm_password" value="" /></td>
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
        header('location: forgot_password.html');
    }

?>
