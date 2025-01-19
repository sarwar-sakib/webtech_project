function validateCampaignName() {
    const campaignName = document.getElementById("campaignName").value.trim();
    const message = document.getElementById("campaignNameMessage");

    if (campaignName.length < 4) {
        message.textContent = "Campaign name must be at least 4 characters.";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

function validateCampaignDomain() {
    const campaignDomain = document.getElementById("campaignDomain").value.trim();
    const message = document.getElementById("campaignDomainMessage");

    if (campaignDomain.length < 4) {
        message.textContent = "Domain must be at least 4 characters.";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

function validateWebsiteUrl() {
    const websiteUrl = document.getElementById("websiteUrl").value.trim();
    const message = document.getElementById("websiteUrlMessage");

    const isValid = /^(https?:\/\/)[a-zA-Z0-9\-\.]+(\:[0-9]+)?(\/[^\s]*)?$/.test(websiteUrl);

    if (websiteUrl === "") {
        message.innerHTML = "Optional";
        message.style.color = "green";
        return true;
    }

    else if (!isValid) {
        message.innerHTML = "Invalid URL format.";
        message.style.color = "red";
        return false;
    }

    else{
        message.innerHTML = "Valid";
        message.style.color = "green";
        return true;
    }
}


function validateBudget() {
    const budget = document.getElementById("budget").value.trim();
    const message = document.getElementById("budgetMessage");

    if (isNaN(budget) || budget < 0) {
        message.textContent = "Budget must be a non-negative number.";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

function validateExpireDate() {
    const expireDate = document.getElementById("expireDate").value;
    const message = document.getElementById("expireDateMessage");
    const currentDate = new Date().toISOString().split("T")[0];

    if (expireDate < currentDate) {
        message.textContent = "Expire date cannot be in the past.";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

function ajaxUpdateCampaign() {
    if (!validateCampaignName() || !validateCampaignDomain() || !validateWebsiteUrl() ||
        !validateBudget() || !validateExpireDate()) {
        alert("Invalid data. Please correct the errors.");
        return;
    }

    const data = {
        campaign_name: document.getElementById("campaignName").value.trim(),
        campaign_domain: document.getElementById("campaignDomain").value.trim(),
        website_url: document.getElementById("websiteUrl").value.trim(),
        budget: document.getElementById("budget").value.trim(),
        expire_date: document.getElementById("expireDate").value,
        submit: true
    };

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controller/updateCampaign.php", true);
    xhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    let info = `info=${encodeURIComponent(JSON.stringify(data))}`;
    xhttp.send(info);

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const response = this.responseText.trim();

            if (response === "success") {
                alert("Campaign updated successfully!");
                window.location.href = "../view/campaignList.php";
            } else {
                alert(response);
            }
        }
    }
}
