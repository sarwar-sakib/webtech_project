function approveAd(adId) {
    // Confirm approval action
    const isConfirmed = confirm("Are you sure you want to approve this ad?");
    if (!isConfirmed) return;

    // Create an AJAX request
    const xhttp = new XMLHttpRequest();
    xhttp.open('GET', `../controller/approveAd.php?id=${adId}`, true);

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                // Handle the response from the server
                alert(this.responseText);
                if (this.responseText.includes("approved successfully")) {
                    // Optionally refresh the page or update the UI dynamically
                    location.reload(); // Refresh the page to reflect the updated status
                }
            } else {
                // Handle errors
                alert("An error occurred while trying to approve the ad.");
            }
        }
    };

    // Send the request
    xhttp.send();
}
function rejectAd(adId) {
    // Confirm rejection action
    const isConfirmed = confirm("Are you sure you want to reject this ad?");
    if (!isConfirmed) return;

    // Create an AJAX request
    const xhttp = new XMLHttpRequest();
    xhttp.open('GET', `../controller/rejectAd.php?id=${adId}`, true);

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                // Handle the response from the server
                alert(this.responseText);
                if (this.responseText.includes("rejected successfully")) {
                    // Optionally refresh the page or update the UI dynamically
                    location.reload(); // Refresh the page to reflect the updated status
                }
            } else {
                // Handle errors
                alert("An error occurred while trying to reject the ad.");
            }
        }
    };

    // Send the request
    xhttp.send();
}