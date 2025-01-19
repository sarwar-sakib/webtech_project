<?php
session_start();
require_once('../model/userModel.php'); 
// Fetch all users from the database
$users = getAllUsers(); 

function getAllUsers() {
    $con = getConnection();  
    $sql = "SELECT id, username, account_type FROM users"; 
    $result = mysqli_query($con, $sql);

    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }

    return $users;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Mail</title>
    <script>
    
    function validateReceiverId() {
        const receiverIdInput = document.querySelector('input[name="receiver_id"]');
        const errorMessage = document.querySelector('#receiver-id-error');
        
        if (!/^\d+$/.test(receiverIdInput.value)) {
            errorMessage.style.display = 'block';  
            receiverIdInput.style.borderColor = 'red';  
        } else {
            errorMessage.style.display = 'none';  
            receiverIdInput.style.borderColor = '';  
        }
    }

    
    function sendMail(event) {
        event.preventDefault(); 
        const receiverId = document.querySelector('input[name="receiver_id"]').value;
        const message = document.querySelector('textarea[name="message"]').value;

        // Check if receiver_id is valid before proceeding
        if (!/^\d+$/.test(receiverId)) {
            alert('Receiver ID must be a number.');
            return;
        }

        const formData = new FormData();
        formData.append('receiver_id', receiverId);
        formData.append('message', message);
        formData.append('submit', true);

        const xhttp = new XMLHttpRequest();

        xhttp.open('POST', '../controller/sendMailHandler.php', true);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                // Parse JSON response
                const response = JSON.parse(this.responseText);

                // Show the appropriate message in a pop-up
                alert(response.message);

                // If success, redirect to mailbox page
                if (response.status === 'success') {
                    window.location.href = "mailbox.php"; // Redirect to mailbox
                }
            }
        };

   
        xhttp.send(new URLSearchParams(formData).toString());
    }

    </script>
</head>
<body>

<link rel="stylesheet" href="../asset/payoutHistory.css">
    <h1>Send Mail</h1>

    <!-- Display users table -->
    <h2>Users List</h2>
    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Account Type</th> <!-- New column for account type -->
        </tr>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['account_type'] ?></td> <!-- Display account type -->
            </tr>
        <?php } ?>
    </table>

    <!-- Send Mail Form -->
    <form onsubmit="sendMail(event)">
        <label for="receiver_id">Receiver ID:</label>
        <input type="text" name="receiver_id" required onkeyup="validateReceiverId()"><br><br>
        <small id="receiver-id-error" style="color: red; display: none;">Receiver ID must be a number.</small><br><br>

        <label for="message">Message:</label><br>
        <textarea name="message" required></textarea><br><br>

        <input type="submit" value="Send Mail">
    </form>

    <br>
    <a href="mailbox.php">Back to Mailbox</a>

</body>
</html>
