// Validate the newspaper name
function validateName() {
    const name = document.getElementById("name").value.trim();
    const message = document.getElementById("nameMessage");

    if (name.length < 4) {
        message.textContent = "Newspaper name must be at least 4 characters.";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

// Validate the price (must be a positive number)
function validatePrice() {
    const price = document.getElementById("price").value.trim();
    const message = document.getElementById("priceMessage");

    if (isNaN(price) || price <= 0) {
        message.textContent = "Price must be a positive numeric value.";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

function deleteNewspaper(id) {
    if (!confirm("Are you sure you want to delete this newspaper?")) {
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../controller/deleteNewspaper.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText.trim() === "success") {
                alert("Newspaper deleted successfully!");
                location.reload();
            } else {
                alert(xhr.responseText);
            }
        }
    };

    xhr.send("id=" + encodeURIComponent(id));
}

// AJAX function to update the newspaper details
function ajaxUpdateNewspaper(id) {
    // Validate all fields before sending data
    if (!validateName() || !validatePrice()) {
        alert("Invalid data. Please correct the errors.");
        return;
    }

    // Collect data from the form fields
    const data = {
        name: document.getElementById("name").value.trim(),
        price: document.getElementById("price").value.trim(),
        submit: true,
        id: id
    };

    // Create a new XMLHttpRequest object
    let xhttp = new XMLHttpRequest();

    // Open a POST request to the PHP controller
    xhttp.open("POST", "../controller/editNewspaper.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    let info = JSON.stringify(data);
    // Send the data to the server as JSON
    xhttp.send("info=" + encodeURIComponent(info));

    // Handle the response from the server
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            // Check for success or failure response
            if (xhttp.responseText.trim() === "success") {
                alert("Newspaper updated successfully!");
                window.location.href = "../view/newspaper-list.php"; // Redirect to the list page
            } else {
                alert(xhttp.responseText); // Show any error message
            }
        }
    };
}
