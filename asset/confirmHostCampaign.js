function validateWebsiteURL() {
    var websiteURL = document.getElementById("website_url").value;
    var messageElement = document.getElementById("websiteURLMessage");

    if (websiteURL.trim() === "") {
        messageElement.innerText = "Website URL cannot be empty.";
        messageElement.style.color = "red";  
        return false;
    } 
    // Validate URL format
    else if (!isValidURL(websiteURL)) {
        messageElement.innerText = "Enter a valid web address.";
        messageElement.style.color = "red";  
        return false;
    } else {
        messageElement.innerText = "Valid URL";
        messageElement.style.color = "green";  
        return true;
    }
}

function isValidURL(url) {
    var pattern = /^(https?:\/\/)([\w\-]+\.)+[\w\-]+(\/[\w\- .\/?%&=]*)?$/i;
    return pattern.test(url);
}

function ajaxHostCampaign() {
    if (!validateWebsiteURL()) {
        alert("Invalid data. Please fix the errors and try again.");
        return;
    }

    var xhttp = new XMLHttpRequest();
    var websiteURL = document.getElementById("website_url").value;

    // Send the data via POST
    xhttp.open("POST", "../controller/confirmHostCampaign.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.send("submit=true&website_url=" + encodeURIComponent(websiteURL));

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var response = this.responseText.trim();
            if (response === "success") {
                alert("Campaign hosted successfully!");
                window.location.href = "../view/campaignList.php";  
            } else {
                alert("Error occurred while hosting the campaign. " +response);
            }
        }
    }
}
