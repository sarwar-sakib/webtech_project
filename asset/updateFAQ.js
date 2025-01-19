function validateFAQTopic() {
    let faqTopic = document.getElementsByName("faq_topic")[0].value;
    let message = document.getElementById("faqTopicMessage");

    if (faqTopic.trim() === "" || faqTopic.length < 5 || /['"]/.test(faqTopic)) {
        message.textContent = "Topic must be at least 5 characters long and cannot contain single or double quotes.";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

function validateFAQQuestion() {
    let faqQuestion = document.getElementsByName("faq_question")[0].value;
    let message = document.getElementById("faqQuestionMessage");

    if (faqQuestion.trim() === "" || faqQuestion.length < 5 || /['"]/.test(faqQuestion)) {
        message.textContent = "Question must be at least 5 characters long and cannot contain single or double quotes.";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

function validateFAQAnswer() {
    let faqAnswer = document.getElementsByName("faq_answer")[0].value;
    let message = document.getElementById("faqAnswerMessage");

    if (faqAnswer.trim() === "" || faqAnswer.length < 5 || /['"]/.test(faqAnswer)) {
        message.textContent = "Answer must be at least 5 characters long and cannot contain single or double quotes.";
        message.style.color = "red";
        return false;
    } else {
        message.textContent = "Valid";
        message.style.color = "green";
        return true;
    }
}

function ajaxUpdateFAQ() {
    if (!validateFAQTopic() || !validateFAQQuestion() || !validateFAQAnswer()) {
        alert("Invalid data. Please fix the errors and try again.");
        return;
    }

    let data = {
        faq_topic: document.getElementsByName("faq_topic")[0].value,
        faq_question: document.getElementsByName("faq_question")[0].value,
        faq_answer: document.getElementsByName("faq_answer")[0].value
    };

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controller/updateFAQ.php", true);
    xhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
    let info = `submit=true&info=${encodeURIComponent(JSON.stringify(data))}`;
    xhttp.send(info);

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let response = this.responseText.trim();

            if (response === "success") {
                alert("FAQ updated successfully! Redirecting to FAQ list.");
                window.location.href = "../view/viewFAQ.php";
            } else {
                alert(response);
            }
        }
    };
}
