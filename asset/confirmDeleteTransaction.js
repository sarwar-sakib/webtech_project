function ajaxDelete() {
    if (confirm("Are you sure you want to delete this transaction?")) {

        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "../controller/confirmDeleteTransaction.php", true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send("submit=true");
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let response = this.responseText.trim();
                if (response === "success") {
                    alert("Transaction deleted successfully!");
                    window.location.href = "../view/transactionList.php";
                } else {
                    alert("Error occurred while deleting the transaction."+response);
                }
            }
        };
    }
}
