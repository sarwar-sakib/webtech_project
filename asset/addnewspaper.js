function validateName() {
    const name = document.getElementById("name").value;
    const message = document.getElementById("nameMessage");

    if (name.trim() === "") {
        message.innerText = "Name cannot be empty.";
        message.style.color = "red";
        return false;
    }

    if (name.trim().length <= 4) {
        message.innerText = "Name must be more than 4 characters.";
        message.style.color = "red";
        return false;
    }

    for (let char of name) {
        if (!isNaN(char) && char !== " ") {
            message.innerText = "Name cannot contain numbers or special characters.";
            message.style.color = "red";
            return false;
        }
    }

    message.innerText = "Valid";
    message.style.color = "green";
    return true;
}

function validatePrice() {
    const price = document.getElementById("price").value;
    const message = document.getElementById("priceMessage");

    if (price.trim() === "" || isNaN(price) || parseFloat(price) < 100) {
        message.innerText = "Please enter a valid price greater than 99.";
        message.style.color = "red";
        return false;
    }

    message.innerText = "Valid";
    message.style.color = "green";
    return true;
}

function ajaxAddNewspaper() {
    if (!validateName() || !validatePrice()) {
        alert("Please fill out all fields correctly before submitting.");
        return;
    }

    const name = document.getElementById("name").value.trim();
    const price = document.getElementById("price").value.trim();

    const info = JSON.stringify({ name, price });

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../controller/addNewspaper.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText.trim() === "success") {
                alert("Newspaper added successfully!");
                window.location.href = "../view/newspaper-list.php";
            } else {
                alert(xhr.responseText);
            }
        }
    };

    xhr.send("info=" + encodeURIComponent(info));
}