function validateCampaignName() {
    let campaignName = document.getElementById("campaignName").value;
    let message = document.getElementById("campaignNameMessage");

    if (campaignName.trim() === "" || campaignName.length < 4 || /[^a-zA-Z0-9\s]/.test(campaignName)) {
        message.textContent = "Campaign name must be at least 4 characters long and contain no special characters.";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

function validateCampaignDomain() {
    let campaignDomain = document.getElementById("campaignDomain").value;
    let message = document.getElementById("campaignDomainMessage");

    if (campaignDomain.trim() === "" || campaignDomain.length < 4 || /[^a-zA-Z0-9\s]/.test(campaignDomain)) {
        message.textContent = "Campaign domain must be at least 4 characters long and contain no special characters.";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

function validateBudget() {
    let budget = document.getElementById("budget").value;
    let message = document.getElementById("budgetMessage");

    if (budget.trim() === "" || isNaN(budget) || Number(budget) < 0) {
        message.textContent = "Budget must be a non-negative numeric value.";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

function validateExpireDate() {
    let expireDate = document.getElementById("expireDate").value;
    let message = document.getElementById("expireDateMessage");

    if (expireDate.trim() === "") {
        message.textContent = "Expire date cannot be empty.";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

function ajaxAddCampaign() {
    if (!validateCampaignName() || !validateCampaignDomain() || !validateBudget() || !validateExpireDate()) {
        alert("Invalid data. Please fix the errors and try again.");
        return;
    }

    let data = {
        campaign_name: document.getElementById("campaignName").value,
        campaign_domain: document.getElementById("campaignDomain").value,
        budget: document.getElementById("budget").value,
        expire_date: document.getElementById("expireDate").value,
        submit: true
    };

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controller/confirmAddCampaign.php", true);
    xhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
    let info = `info=${encodeURIComponent(JSON.stringify(data))}`;
    xhttp.send(info);

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let response = this.responseText.trim();

            if (response === "success") {
                alert("Campaign added successfully! Redirecting to campaign list.");
                window.location.href = "../view/campaignList.php";
            } else {
                alert(response);
            }
        }
    };
}
