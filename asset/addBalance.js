function handleOperatorSelection() {
    const operatorInputs = document.getElementsByName('operator');
    const additionalFields = document.getElementById('additional-fields');

    // Check if any operator is selected
    let isOperatorSelected = false;
    for (let input of operatorInputs) {
        if (input.checked) {
            isOperatorSelected = true;
            break;
        }
    }

    // Toggle visibility of additional fields
    if (isOperatorSelected) {
        additionalFields.classList.remove('hidden');
    } else {
        additionalFields.classList.add('hidden');
    }
}

// Phone validation
function validatePhone() {
    const phone = document.getElementById('mobile_number').value;
    const phoneError = document.getElementById('phone_error');

    // Phone number validation
    if (!/^01\d{9}$/.test(phone)) {
        phoneError.textContent = "Mobile/account number must be 11 digits valid number.";
        return false;
    } else {
        phoneError.textContent = "";
        return true;
    }
}

// Amount validation
function validateAmount() {
    const amount = parseInt(document.getElementById('amount').value);
    const amountError = document.getElementById('amount_error');

    if (amount < 99) {
        amountError.textContent = "Minimum amount 100";
        return false;
    } else {
        amountError.textContent = "";
        return true;
    }
}

// Password validation
function validatePassword() {
    const password = document.getElementById('password').value;
    const passwordError = document.getElementById('password_error');

    if (!/^\d{4,5}$/.test(password)) {
        passwordError.textContent = "Password must be 4-5 digits (no characters).";
        return false;
    } else {
        passwordError.textContent = "";
        return true;
    }
}

function validateForm() {
    // Call individual validation functions and check if all fields are valid
    return validatePhone() && validateAmount() && validatePassword();
}

function ajaxAddBalance(event) {
    // Prevent form submission if validation fails
    if (!validateForm()) {
        event.preventDefault(); // Prevent form submission if validation fails
        return;
    }

    // Collect Data
    let data = {
        operator: document.querySelector('input[name="operator"]:checked')?.value,
        mobile_number: document.getElementById("mobile_number").value.trim(),
        amount: parseInt(document.getElementById("amount").value.trim()),
        submit: true,
    };

    // AJAX Request
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controller/add_balance.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    let info = `info=${encodeURIComponent(JSON.stringify(data))}`;
    xhttp.send(info);

    // Response Handling
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let response = this.responseText.trim();
            if (response === "success") {
                alert("Balance added successfully!");
                window.location.href = "../view/home.php"; // Redirect after success
            } else {
                alert(response); // Show error message from server
            }
        }
    };
}
