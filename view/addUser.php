<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <script>
        // Real-time validation for username
        function validateUsername() {
            const username = document.querySelector('input[name="username"]').value.trim();
            const usernameError = document.getElementById("usernameError");
            const regex = /^[a-zA-Z]+$/; // Username should only contain letters

            if (username === "") {
                usernameError.textContent = "Username cannot be empty!";
                return false;
            } else if (!regex.test(username)) {
                usernameError.textContent = "Username can only contain letters!";
                return false;
            } else {
                usernameError.textContent = ""; // Clear error message
                return true;
            }
        }

        // Real-time validation for email
        function validateEmail() {
            const email = document.querySelector('input[name="email"]').value.trim();
            const emailError = document.getElementById("emailError");
            const regex = /^[^0-9][a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Email should not start with a number

            if (email === "") {
                emailError.textContent = "Email cannot be empty!";
                return false;
            } else if (!regex.test(email)) {
                emailError.textContent = "Email cannot start with a number!";
                return false;
            } else {
                emailError.textContent = ""; // Clear error message
                return true;
            }
        }

        // Real-time validation for password
        function validatePassword() {
            const password = document.querySelector('input[name="password"]').value.trim();
            const passwordError = document.getElementById("passwordError");

            if (password === "") {
                passwordError.textContent = "Password cannot be empty!";
                return false;
            } else if (password.length < 4) {
                passwordError.textContent = "Password must be at least 4 characters long!";
                return false;
            } else {
                passwordError.textContent = ""; // Clear error message
                return true;
            }
        }

        // Validate form before submission
        function validateForm() {
            return validateUsername() && validateEmail() && validatePassword();
        }

        // AJAX request to submit form data
        function submitForm(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            if (!validateForm()) {
                alert("Invalid data. Please fix the errors and try again.");
                return;
            } // Validate the form first

            let data = {
                username: document.querySelector('input[name="username"]').value.trim(),
                email: document.querySelector('input[name="email"]').value.trim(),
                password: document.querySelector('input[name="password"]').value.trim(),
                account_type: document.querySelector('select[name="account_type"]').value.trim(),
                question: "What color?", // Fixed security question
                answer: "Blue", // Fixed security answer
            };

            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../controller/confirmAdd.php', true);
            xhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
            let info = `submit=true&info=${encodeURIComponent(JSON.stringify(data))}`;
            xhttp.send(info);

            xhttp.onreadystatechange = function () {
                if (this.readyState === 4) {
                    try {
                        const response = JSON.parse(this.responseText);
                        alert(response.message); // Display the message to the user

                        if (response.status === 'success') {
                            window.location.href = '../view/userlist.php'; // Redirect on success
                        }
                    } catch (e) {
                        alert("Error parsing server response. Please try again later.");
                        console.error("Invalid JSON response:", this.responseText);
                    }
                }
            };
        }
    </script>
</head>
<body>
<link rel="stylesheet" href="../asset/adduser.css">
    <h2>Add User</h2>
    <form method="post" action="javascript:void(0);" onsubmit="submitForm(event)">
        <table border="1" cellspacing="0">
            <tr>
                <td>Username:</td>
                <td>
                    <input type="text" name="username" onkeyup="validateUsername()" required>
                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>
                    <input type="email" name="email" onkeyup="validateEmail()" required>
                </td>
            </tr>
            <tr>
                <td>Password:</td>
                <td>
                    <input type="password" name="password" onkeyup="validatePassword()" required>
                </td>
            </tr>
            <tr>
                <td>Account Type:</td>
                <td>
                    <select name="account_type" required>
                        <option value="advertiser">Advertiser</option>
                        <option value="webmaster">Webmaster</option>
                        <option value="admin">Admin</option>
                    </select>
                </td>
            </tr>
        </table>
        <div style="color: red;">
            <span id="usernameError"></span><br>
            <span id="emailError"></span><br>
            <span id="passwordError"></span>
        </div>
        <hr>
        <input type="submit" name="submit" value="Add User">
    </form>
    <br>
    <a href="userlist.php">Cancel</a>
</body>
</html>
