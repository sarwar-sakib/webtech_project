function validateName() {
    const name = document.getElementById("username").value.trim();
    const nameError = document.getElementById("name-error");
    if (!name || !isNaN(name)) {
        nameError.style.display = "inline";
    } else {
        nameError.style.display = "none";
    }
}

function validateEmail() {
    const email = document.getElementById("email").value.trim();
    const emailError = document.getElementById("email-error");
    if (!email || /^\d/.test(email)) {
        emailError.style.display = "inline";
    } else {
        emailError.style.display = "none";
    }
}

function validatePassword() {
    const password = document.getElementById("password").value.trim();
    const passwordError = document.getElementById("password-error");
    if (password.length < 4) {
        passwordError.style.display = "inline";
    } else {
        passwordError.style.display = "none";
    }
}

function validateConfirmPassword() {
    const password = document.getElementById("password").value.trim();
    const confirmPassword = document.getElementById("confirm_password").value.trim();
    const confirmPasswordError = document.getElementById("confirm-password-error");
    if (password !== confirmPassword) {
        confirmPasswordError.style.display = "inline";
    } else {
        confirmPasswordError.style.display = "none";
    }
}

function validateForm() {
    // Call all validation functions
    validateName();
    validateEmail();
    validatePassword();
    validateConfirmPassword();

    // Check if any errors are displayed
    const errors = document.querySelectorAll("small[style='color: red; display: inline;']");
    return errors.length === 0; // If no errors, form is valid
}