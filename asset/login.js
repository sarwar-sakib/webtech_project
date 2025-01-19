function validateUsername() {
    let username = document.getElementById("username").value;
    let message = document.getElementById("usernameMessage");

    if (username.trim() === "") {
        message.textContent = "Cannot be empty";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

function validatePassword() {
    let password = document.getElementById("password").value;
    let message = document.getElementById("passwordMessage");

    if (password.trim() === "") {
        message.textContent = "Cannot be empty";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

function ajaxLogin() {
    if (!validateUsername() || !validatePassword()) {
        alert("Invalid data");
        return;
    }

    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let xhttp = new XMLHttpRequest();

    xhttp.open("POST", "../controller/logincheck.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(
        `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}&submit=true`
    );

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let response = this.responseText.trim();

            if (response === "success") {
                window.location.href = "../view/home.php";
            } else if (response === "invalid") {
                alert("Invalid username or password!");
            } else {
                alert(response);
            }
        }
    };
}
