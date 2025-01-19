// Validation functions for username, email, and password
function validateUsername() {
    const usernameField = document.getElementById('username');
    const usernameError = document.getElementById('usernameError');
    const usernameRegex = /^[A-Za-z]+$/;

    if (!usernameRegex.test(usernameField.value)) {
        usernameError.textContent = "Name cannot be empty or contain number.";
        return false;
    } else {
        usernameError.textContent = "";
        return true;
    }
}

function validateEmail() {
const emailField = document.getElementById('email');
const emailError = document.getElementById('emailError');
// Updated regex: Email should end with @ followed by a domain and a dot
const emailFormat = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

if (!emailFormat.test(emailField.value)) {
emailError.textContent = "Invalid (e.g 'example@domain.com')";
return false;
} else {
emailError.textContent = "";
return true;
}
}


function validatePassword() {
    const passwordField = document.getElementById('password');
    const passwordError = document.getElementById('passwordError');

    if (passwordField.value.length < 4) {
        passwordError.textContent = "Password must be at least 4 characters long.";
        return false;
    } else {
        passwordError.textContent = "";
        return true;
    }
}

// Function to handle AJAX form submission
function submitForm(event) {
    event.preventDefault();

    // Perform all validations
    if (!validateUsername() || !validateEmail() || !validatePassword()) {
        alert('Please fix the errors before submitting.');
        return;
    }

    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();

    // Prepare data for AJAX (JSON format)
    const data = {
        username: username,
        email: email,
        password: password
    };

    // AJAX request
    const xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/update.php', true);
    xhttp.setRequestHeader('Content-Type', 'application/json');

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const response = JSON.parse(this.responseText);
            if (response.status === 'success') {
                alert('Profile updated successfully!');
                window.location.href = 'profile.php?id=' + response.userId;
            } else {
                alert('An error occurred: ' + response.message);
            }
        }
    };

    // Send the JSON data
    xhttp.send(JSON.stringify(data));
}