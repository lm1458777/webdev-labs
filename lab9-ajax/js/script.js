function feedbackForm() {
    return document.getElementById('feedback-form');
}

function isValid(value) {
    return value == 'correct';
}

function setValidValue(fieldId, isValid) {
    const style = 'invalid_value';
    const nameField = document.getElementById(fieldId);
    if (isValid) {
        nameField.classList.remove(style);
    } else {
        nameField.classList.add(style);
    }
}

function showSubmissionResult(show) {
    const style = 'hidden';
    const result = document.getElementById('submission-result');
    if (show) {
        result.classList.remove(style);
    } else {
        result.classList.add(style);
    }

}

function updateView(newState) {
    const isNameValid = isValid(newState.name);
    const isEmailValid = isValid(newState.email);

    setValidValue('name', isNameValid);
    setValidValue('email', isEmailValid);

    showSubmissionResult(isNameValid && isEmailValid);
}

async function submit() {
    console.log('2 submission start');
    const form = feedbackForm();
    const formData = new FormData(form);
    const response = await fetch(
        '/feedback.php',
        {
            method: 'POST',
            body: formData
        }
    )
    updateView(await response.json());
    console.log('2 submission end');
}

function init() {
    var submission = false;

    const form = feedbackForm();

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        if (submission) {
            console.log('skip');
            return;
        }
        submission = true;
        showSubmissionResult(false);
        console.log('set submission');
        submit().finally(function () {
            submission = false;
            console.log('reset submission');
        });
    });
}

window.onload = init