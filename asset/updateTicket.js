function validateTicketSolution() {
    let ticketSolution = document.getElementById("ticket_solution").value;
    let messageElement = document.getElementById("ticketSolutionMessage");

    if (ticketSolution.trim() === "") {
        messageElement.innerText = "Response field cannot be empty.";
        messageElement.style.color = "red";  
        return false;
    } else {
        messageElement.innerText = "Valid";
        messageElement.style.color = "green";  
        return true;
    }
}

function ajaxUpdateTicket() {
    if(!validateTicketSolution()){
        alert("Invalid data. Please fix the errors and try again.");
        return;
    }
    let xhttp = new XMLHttpRequest();
    let ticketSolution = document.getElementById("ticket_solution").value;

    xhttp.open("POST", "../controller/updateTicket.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.send("submit=true&ticket_solution=" + encodeURIComponent(ticketSolution));

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let response = this.responseText.trim();
            if (response === "success") {
                alert("Ticket updated successfully!");
                window.location.href = "../view/viewTickets.php"; 
            } else {
                alert("Error occurred while updating the ticket.");
            }
        }
    }
}

