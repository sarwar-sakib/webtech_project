function confirmSubmission() {

    const isConfirmed = confirm("Are you sure you want to submit the payment and submit the ad?");
    if (isConfirmed) {
        const adId = document.getElementById('ad_id').value;
        const formData = new FormData();
        formData.append('ad_id', adId);

        const xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../controller/submitAd.php', true);

        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                const response = this.responseText.trim();
                
                if (response === 'success') {
                    alert('Payment confirmed and ad submitted successfully!');
                    window.location.href = 'ad_list.php';
                } else {
                    alert('Insufficient Balance!. Please add balance and try again.');
                }
            }
        };

        xhttp.send(formData);
    }
}