document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('feedback-form');
    const feedbackInput = document.getElementById('feedback-input');

    const validateFeedback = () => {
        const feedback = feedbackInput.value.trim();

        if (feedback === "") {
            return "Feedback cannot be empty.";
        }
        if (feedback.length < 10) {
            return "Feedback must be at least 10 characters long.";
        }
        if (feedback.length > 500) {
            return "Feedback cannot exceed 500 characters.";
        }
        return ""; // No errors
    };

    feedbackInput.addEventListener('keyup', () => {
        const message = validateFeedback();
        const messageContainer = document.getElementById('message-container');
        messageContainer.textContent = message;
        messageContainer.style.color = message ? "red" : "green";
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const errorMessage = validateFeedback();
        
        if (errorMessage) {
            alert(errorMessage);
            return;
        }

        // AJAX request
        const feedback = feedbackInput.value.trim();
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'submit-feedback.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    alert(response.message); // Display success message
                    window.location.href = "../view/home.php";
                } else {
                    alert(response.message); // Display error message
                }
            }
        };
        xhr.send(`feedback=${encodeURIComponent(feedback)}`);
    });
});
