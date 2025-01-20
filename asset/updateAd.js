function updateAd() {
    document.querySelectorAll('.error-message').forEach(span => span.textContent = '');

    const adId = document.getElementById('ad_id').value;
    const publishDate = document.getElementById('publish_date').value.trim();
    const adType = document.getElementById('ad_type').value;
    const adDescription = document.getElementById('ad_description').value.trim();
    const adImage = document.getElementById('ad_image').files[0]; // Get the image file
    const newspaper = document.getElementById('hidden_newspaper').value;
    const price = document.getElementById('hidden_price').value;

    let isValid = true;

    if (!publishDate) {
        document.getElementById('error-publish_date').textContent = 'Publication date is required.';
        isValid = false;
    }
    if (!adType) {
        document.getElementById('error-ad_type').textContent = 'Ad type is required.';
        isValid = false;
    }
    if (!adDescription) {
        document.getElementById('error-ad_description').textContent = 'Ad description is required.';
        isValid = false;
    } else {
        const wordCount = adDescription.split(/\s+/).filter(word => word).length;
        if (wordCount > 40) {
            document.getElementById('error-ad_description').textContent = 'Ad description cannot exceed 40 words.';
            isValid = false;
        }
    }

    if (!isValid) {
        return; 
    }

    const formData = new FormData();
    formData.append('ad_id', adId);
    formData.append('publish_date', publishDate);
    formData.append('ad_type', adType);
    formData.append('ad_description', adDescription);
    formData.append('newspaper', newspaper);
    formData.append('price', price);
    if (adImage) formData.append('ad_image', adImage);

    const xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/update_ad.php', true);

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const response = JSON.parse(this.responseText);

            if (response.status === 'success') {
                alert(response.message);
                window.location.href = response.redirect;
            } else {
                alert(response.message);
            }
        }
    };

    xhttp.send(formData);
}