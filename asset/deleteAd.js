function deleteAd(adId) {
    // Confirm with the user before deleting
    if (confirm('Are you sure you want to delete this ad?')) {
        // Create a new XMLHttpRequest object
        const xhttp = new XMLHttpRequest();
        
        // Open a GET request to the delete_ad.php with the ad ID
        xhttp.open('GET', '../controller/delete_ad.php?id=' + adId, true);

        // Define what happens when the request is complete
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                // Check the response from the server
                const response = this.responseText.trim();
                
                if (response === 'success') {
                    alert('Ad deleted successfully');
                    window.location.href = '../view/ad_list.php'; // Redirect after successful deletion
                } else {
                    alert('Failed to delete ad. Try again.');
                }
            }
        };

        // Send the request
        xhttp.send();
    }
}