function validateForm() {
    const adDescription = document.getElementById('ad_description').value.trim();
    const adImage = document.getElementById('ad_image').value;
    const publishDate = document.getElementById('publish_date').value;
    const adType = document.querySelector('input[name="ad_type"]:checked')?.value; // Get the selected ad type
    const maxWords = 40;
    let isValid = true;

    // Validate Ad Description (Not empty and within word limit)
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

    // Validate Ad Image file type (Only for Classified Display)
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

    // Validate Publish Date (Ensure it's not in the past)
    if (!publishDate) {
        document.getElementById('publish_date').setCustomValidity("Publication day is required.");
        isValid = false;
    } else {
        document.getElementById('publish_date').setCustomValidity(""); // Reset custom validity
    }

    return isValid;
}

function validateDate() {
    const publishDate = document.getElementById('publish_date').value;
    const today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format

    if (publishDate < today) {
        document.getElementById('publish_date').setCustomValidity('The date cannot be in the past.');
        return false;
    } else {
        document.getElementById('publish_date').setCustomValidity(''); // Clear custom validity if date is valid
        return true;
    }
}

function toggleImageField() {
    // Get the selected ad type
    const adType = document.querySelector('input[name="ad_type"]:checked')?.value;

    // Show or hide the image upload field based on the selected ad type
    const imageField = document.getElementById('image_upload_field');
    if (adType === "Classified Display") {
        imageField.style.display = "block"; // Show the field
    } else {
        imageField.style.display = "none"; // Hide the field
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const today = new Date();
    today.setHours(0, 0, 0, 0); // Set time to midnight

    const formattedDate = today.toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
    document.getElementById('publish_date').setAttribute('min', formattedDate);
});

document.getElementById('adForm').addEventListener('submit', function (event) {
event.preventDefault(); // Prevent the default form submission

// Create a new FormData object
var formData = new FormData(this);

// Create an XMLHttpRequest object
var xhr = new XMLHttpRequest();

// Open a POST request
xhr.open('POST', '../controller/create_ad.php', true);

// Set up an event listener to handle the response
xhr.onload = function () {
    if (xhr.status === 200) {
        try {
            // Parse the JSON response
            var response = JSON.parse(xhr.responseText);

            // Check if the response is successful
            if (response.success) {
                alert(response.message); // Show a success alert
                window.location.href = 'ad_list.php'; // Redirect to ad_list.php
            } else {
                // Display the error message
                document.getElementById('responseMessage').innerHTML = `<p style="color: red;">${response.message}</p>`;
            }
        } catch (e) {
            // Handle JSON parsing errors
            document.getElementById('responseMessage').innerHTML = `<p style="color: red;">Invalid response from server.</p>`;
        }
    } else {
        // Display a generic error message if the request fails
        document.getElementById('responseMessage').innerHTML = `<p style="color: red;">Error: ${xhr.status}</p>`;
    }
};

// Send the form data
xhr.send(formData);
});
