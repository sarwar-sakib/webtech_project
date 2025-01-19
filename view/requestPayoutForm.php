<html>
<head>
    <title>Request Payout</title>
    <script>
        function submitPayoutRequest(event) {
            event.preventDefault(); // Prevent the form from reloading the page

            const amount = document.getElementById('amount').value;

            // Perform an AJAX request
            fetch('../view/requestPayoutForm.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({ amount: amount }),
            })
            .then(response => response.json())
            .then(data => {
                // Display feedback to the user
                const messageElement = document.getElementById('message');
                if (data.status === 'success') {
                    messageElement.style.color = 'green';
                } else {
                    messageElement.style.color = 'red';
                }
                messageElement.textContent = data.message;
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while processing your request.');
            });
        }
    </script>
</head>
<body>
    <h2>Request Payout</h2>
    <div id="message"></div>
    <form onsubmit="submitPayoutRequest(event)">
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" required>
        <button type="submit">Submit</button>
    </form>
    <a href="payout.php">Back</a>
</body>
</html>
