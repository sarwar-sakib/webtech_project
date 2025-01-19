function ajaxDelete() {
    if (confirm("Are you sure you want to delete this campaign?")) {
        let xhttp = new XMLHttpRequest();

        xhttp.open("POST", "../controller/confirmDeleteCampaign.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhttp.send("submit=true");

        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                let response = this.responseText.trim();
                if (response === "success") {
                    alert("Campaign deleted successfully!");
                    window.location.href = "../view/campaignList.php"; 
                } else {
                    alert("Error occurred while deleting the campaign.");
                }
            }
        };
    }
}
