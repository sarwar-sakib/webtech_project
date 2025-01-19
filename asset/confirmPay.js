// JavaScript function to confirm before submitting
function confirmSubmission() {
    // Confirm alert
    const isConfirmed = confirm("Are you sure you want to submit the payment and submit the ad?");
    if (isConfirmed) {
        // Prepare the form data to send via AJAX
        const adId = document.getElementById('ad_id').value;

        // Create FormData object to send data
        const formData = new FormData();
        formData.append('ad_id', adId);

        // Create an XMLHttpRequest object for AJAX
        const xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../controller/submitAd.php', true);

        // Handle the response from the server
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                const response = this.responseText.trim();
                
                // If successful, redirect to the ad list page
                if (response === 'success') {
                    alert('Payment confirmed and ad submitted successfully!');
                    window.location.href = 'ad_list.php';
                } else {
                    alert('Insufficient Balance!. Please add balance and try again.');
                }
            }
        };

        // Send the request with the form data
        xhttp.send(formData);
    }
}