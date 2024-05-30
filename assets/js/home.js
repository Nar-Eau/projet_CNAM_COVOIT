let currentQuestionIndex = 0;
const questions = document.querySelectorAll('.question');
const nextButton = document.getElementById('nextButton');
const submitButton = document.getElementById('submitButton');

function showQuestion(index) {
    if (index >= 0 && index < questions.length) {
        if (index > 0) {
            questions[currentQuestionIndex].style.display = 'none';
        }
        questions[index].style.display = 'block';
        currentQuestionIndex = index;

        if (currentQuestionIndex === questions.length - 1) {
            nextButton.style.display = 'none';
            submitButton.style.display = 'block';
        }
    }
}

nextButton.addEventListener('click', function() {
    const currentQuestion = questions[currentQuestionIndex];
    const radioButtons = currentQuestion.querySelectorAll('input[type=\"radio\"]');
    let answerSelected = false;

    for (const radioButton of radioButtons) {
        if (radioButton.checked) {
            answerSelected = true;
            break;
        }
    }

    if (answerSelected) {
        showQuestion(currentQuestionIndex + 1);
    } else {
        alert('Veuillez sélectionner une réponse avant de passer à la question suivante.');
    }
});

showQuestion(currentQuestionIndex);