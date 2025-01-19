function ajaxDeleteTicket() {
    let confirmation = confirm("Are you sure you want to delete this ticket?");
    
    if (!confirmation) {
        return; 
    }
    
    let xhttp = new XMLHttpRequest();

    xhttp.open("POST", "../controller/confirmDeleteTicket.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.send("submit=true");

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let response = this.responseText.trim();
            if (response === "success") {
                alert("Ticket deleted successfully!");
                window.location.href = "../view/viewTickets.php"; 
            } else {
                alert("Error occurred while deleting the ticket.");
            }
        }
    }
}
