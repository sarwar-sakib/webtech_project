function validateTicketDescription() {
    let ticketDescField = document.getElementById("ticket_desc");
    let message = document.getElementById("ticketDescMessage");
    let value = ticketDescField.value.trim();

    if (value === "") {
        message.textContent = "Ticket description cannot be empty.";
        message.style.color = "red";
        return false;
    } else if (value.length < 5) {
        message.textContent = "Description must be at least 5 characters long.";
        message.style.color = "red";
        return false;
    } else if (/[^a-zA-Z0-9\s.,]/.test(value)) {
        message.textContent = "Description contains invalid characters.";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid"; 
        message.style.color = "green";
        return true;
    }
}

function ajaxFileTicket() {
    let ticketDescField = document.getElementById("ticket_desc").value.trim();

    // Validate before submission
    if (!validateTicketDescription()) {
        alert("Please resolve validation issues before submitting.");
        return;
    }

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controller/confirmAddTicket.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("submit=true&ticket_desc=" + encodeURIComponent(ticketDescField));

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (this.responseText === "success") {
                alert("Ticket filed successfully!");
                window.location.href = "../view/viewFAQ.php"; 
            } else {
                alert(this.responseText); 
            }
        }
    }
}
