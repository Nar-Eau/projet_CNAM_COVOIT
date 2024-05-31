window.onload = function() {
    let currentQuestionIndex = 0;
    const questions = document.querySelectorAll('.question-container');
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

    function modifyBeforeContent(element, newContent) {
        element.style.setProperty('--before-content', `"${newContent}"`);

    }

    function putLettersOnBefore() {
        const answers = document.querySelectorAll('.answer label');
        
        answers.forEach(answer => {
            const input = answer.getElementsByTagName('input')[0];
            const dataIndex = parseInt(input.getAttribute('data-index')); // Convertir en nombre

            let letterValue = "";

            switch (dataIndex) {
                case 0:
                    letterValue = "A";
                    break;
                case 1:
                    letterValue = "B";
                    break;
                case 2:
                    letterValue = "C";
                    break;
                case 3:
                    letterValue = "D";
                    break;
                default:
                    break;
            }

            console.log(answer);

            console.log(dataIndex, letterValue);
            modifyBeforeContent(answer, letterValue);
        });
    }



    showQuestion(currentQuestionIndex);
    putLettersOnBefore();
}


