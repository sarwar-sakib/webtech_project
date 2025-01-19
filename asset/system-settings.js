document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('time-format-form');
    const timeFormatSelect = document.getElementById('time-format');
    const currentTime = document.getElementById('current-time');
    const messageElement = document.getElementById('message');

    // Event listener for the form submission
    form.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent form submission

        const selectedFormat = timeFormatSelect.value;

        // AJAX request to update time format
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'system-settings.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    alert(response.message); // Show success message in alert
                    currentTime.textContent = response.current_time; // Update current time display
                } else {
                    messageElement.style.color = 'red';
                    messageElement.textContent = response.message; // Show error message
                    messageElement.style.display = 'block';
                }
            } else {
                messageElement.style.color = 'red';
                messageElement.textContent = 'An error occurred while updating time format.';
                messageElement.style.display = 'block';
            }
        };

        xhr.send(`action=update_time_format&time_format=${selectedFormat}`);
    });
});
