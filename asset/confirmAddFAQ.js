function validateFAQTopic() {
    let faqTopic = document.getElementById("faq_topic").value;
    let message = document.getElementById("faqTopicMessage");

    if (faqTopic.trim() === "" || faqTopic.length < 5 || /['"]/g.test(faqTopic)) {
        message.textContent = "FAQ topic must be at least 5 characters long and contain no single or double quotes.";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

function validateFAQQuestion() {
    let faqQuestion = document.getElementById("faq_question").value;
    let message = document.getElementById("faqQuestionMessage");

    if (faqQuestion.trim() === "" || faqQuestion.length < 5 || /['"]/g.test(faqQuestion)) {
        message.textContent = "Question must be at least 5 characters long and contain no single or double quotes.";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

function validateFAQAnswer() {
    let faqAnswer = document.getElementById("faq_answer").value;
    let message = document.getElementById("faqAnswerMessage");

    if (faqAnswer.trim() === "" || faqAnswer.length < 5 || /['"]/g.test(faqAnswer)) {
        message.textContent = "Answer must be at least 5 characters long and contain no single or double quotes.";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

function ajaxAddFAQ() {
    if (!validateFAQTopic() || !validateFAQQuestion() || !validateFAQAnswer()) {
        alert("Invalid data. Please fix the errors and try again.");
        return;
    }

    let data = {
        faq_topic: document.getElementById("faq_topic").value,
        faq_question: document.getElementById("faq_question").value,
        faq_answer: document.getElementById("faq_answer").value,
        submit: true
    };

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controller/confirmAddFAQ.php", true);
    xhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
    let info = `info=${encodeURIComponent(JSON.stringify(data))}`;
    xhttp.send(info);

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let response = this.responseText.trim();

            if (response === "success") {
                alert("FAQ added successfully! Redirecting to FAQ list.");
                window.location.href = "../view/viewFAQ.php";  
            } else {
                alert(response);
            }
        }
    };
}
