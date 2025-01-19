<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Mail</title>
    <script>
    // Function to validate receiver_id to accept only numeric values
    function validateReceiverId() {
        const receiverIdInput = document.querySelector('input[name="receiver_id"]');
        const errorMessage = document.querySelector('#receiver-id-error');
        
        // Check if the value is a valid number
        if (!/^\d+$/.test(receiverIdInput.value)) {
            errorMessage.style.display = 'block';  // Show error message
            receiverIdInput.style.borderColor = 'red';  // Change border color to red
        } else {
            errorMessage.style.display = 'none';  // Hide error message
            receiverIdInput.style.borderColor = '';  // Reset border color
        }
    }

    // Function to send mail via AJAX
    function sendMail(event) {
        event.preventDefault(); // Prevent default form submission

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

        // Send data as URL parameters
        xhttp.send(new URLSearchParams(formData).toString());
    }
</script>
</head>
<body>
    <h1>Send Mail</h1>
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
