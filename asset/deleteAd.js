function deleteAd(adId) {
    if (confirm('Are you sure you want to delete this ad?')) {

        const xhttp = new XMLHttpRequest();
        
        xhttp.open('GET', '../controller/delete_ad.php?id=' + adId, true);

        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                const response = this.responseText.trim();
                
                if (response === 'success') {
                    alert('Ad deleted successfully');
                    window.location.href = '../view/ad_list.php'; 
                } else {
                    alert('Failed to delete ad. Try again.');
                }
            }
        };

        xhttp.send();
    }
}