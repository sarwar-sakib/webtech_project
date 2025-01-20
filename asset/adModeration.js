function approveAd(adId) {

    const isConfirmed = confirm("Are you sure you want to approve this ad?");
    if (!isConfirmed) return;

    const xhttp = new XMLHttpRequest();
    xhttp.open('GET', `../controller/approveAd.php?id=${adId}`, true);

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {

                alert(this.responseText);
                if (this.responseText.includes("approved successfully")) {
                    location.reload(); 
                }
            } else {
                alert("An error occurred while trying to approve the ad.");
            }
        }
    };
    xhttp.send();
}
function rejectAd(adId) {
    const isConfirmed = confirm("Are you sure you want to reject this ad?");
    if (!isConfirmed) return;

    // Create an AJAX request
    const xhttp = new XMLHttpRequest();
    xhttp.open('GET', `../controller/rejectAd.php?id=${adId}`, true);

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                alert(this.responseText);
                if (this.responseText.includes("rejected successfully")) {
                    location.reload(); 
                }
            } else {
                alert("An error occurred while trying to reject the ad.");
            }
        }
    };

    // Send the request
    xhttp.send();
}