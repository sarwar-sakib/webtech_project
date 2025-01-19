function validateAdvertisingBrand() {
    const brandField = document.getElementById("advertising_brand");
    const message = document.getElementById("advertisingBrandMessage");
    const value = brandField.value.trim();

    if (value === "") {
        message.textContent = "Advertising brand cannot be empty.";
        message.textContent.style.color = "red";
        return false;
    } else if (value.length < 3) {
        message.textContent = "Brand name must be at least 3 characters.";
        message.textContent.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid"; 
        message.textContent.style.color = "green";
        return true;
    }
}

function ajaxJoinCampaign() {
    const brandField = document.getElementById("advertising_brand");
    const advertisingBrand = brandField.value.trim();

    if (!validateAdvertisingBrand()) {
        alert("Please resolve validation issues before submitting.");
        return;
    }

    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controller/confirmJoinCampaign.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.send("submit=true&advertising_brand=" + encodeURIComponent(advertisingBrand));
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (this.responseText === "success") {
                alert("You have successfully joined the campaign!");
                window.location.href = "../view/campaignList.php";
            } else {
                alert(this.responseText); 
            }
        }
    };

    xhttp.send(`submit=true&advertising_brand=${encodeURIComponent(advertisingBrand)}`);
}
