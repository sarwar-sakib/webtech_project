function validateForm() {
    const adDescription = document.getElementById('ad_description').value.trim();
    const adImage = document.getElementById('ad_image').value;
    const publishDate = document.getElementById('publish_date').value;
    const adType = document.querySelector('input[name="ad_type"]:checked')?.value; 
    const maxWords = 40;
    let isValid = true;

    const wordCount = adDescription.split(/\s+/).filter(word => word).length;
    if (!adDescription) {
        document.getElementById('description_error').textContent = "Ad description cannot be empty.";
        isValid = false;
    } else if (wordCount > maxWords) {
        document.getElementById('description_error').textContent = `Ad description cannot exceed ${maxWords} words. Current count: ${wordCount}`;
        isValid = false;
    } else {
        document.getElementById('description_error').textContent = '';
    }

    if (adType === "Classified Display") {
        if (!adImage) {
            document.getElementById('image_error').textContent = "An image is required for Classified Display ads.";
            isValid = false;
        } else {
            const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(adImage)) {
                document.getElementById('image_error').textContent = "Only JPG, JPEG, PNG, or GIF files are allowed.";
                isValid = false;
            } else {
                document.getElementById('image_error').textContent = '';
            }
        }
    }

    if (!publishDate) {
        document.getElementById('publish_date').setCustomValidity("Publication day is required.");
        isValid = false;
    } else {
        document.getElementById('publish_date').setCustomValidity(""); 
    }

    return isValid;
}

function validateDate() {
    const publishDate = document.getElementById('publish_date').value;
    const today = new Date().toISOString().split('T')[0]; 

    if (publishDate < today) {
        document.getElementById('publish_date').setCustomValidity('The date cannot be in the past.');
        return false;
    } else {
        document.getElementById('publish_date').setCustomValidity(''); 
        return true;
    }
}

function toggleImageField() {
    const adType = document.querySelector('input[name="ad_type"]:checked')?.value;

    const imageField = document.getElementById('image_upload_field');
    if (adType === "Classified Display") {
        imageField.style.display = "block"; 
    } else {
        imageField.style.display = "none"; 
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const today = new Date();
    today.setHours(0, 0, 0, 0); 

    const formattedDate = today.toISOString().split('T')[0];
    document.getElementById('publish_date').setAttribute('min', formattedDate);
});

document.getElementById('adForm').addEventListener('submit', function (event) {
event.preventDefault(); 

var formData = new FormData(this);

var xhr = new XMLHttpRequest();

xhr.open('POST', '../controller/create_ad.php', true);

xhr.onload = function () {
    if (xhr.status === 200) {
        try {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert(response.message); 
                window.location.href = 'ad_list.php'; 
            } else {
                document.getElementById('responseMessage').innerHTML = `<p style="color: red;">${response.message}</p>`;
            }
        } catch (e) {
            document.getElementById('responseMessage').innerHTML = `<p style="color: red;">Invalid response from server.</p>`;
        }
    } else {
        document.getElementById('responseMessage').innerHTML = `<p style="color: red;">Error: ${xhr.status}</p>`;
    }
};

xhr.send(formData);
});
