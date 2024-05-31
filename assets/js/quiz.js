window.onload = function() {
    let currentQuestionIndex = 0;
    const questions = document.querySelectorAll('.question-container');
    const nextButton = document.getElementById('nextButton');
    const submitButton = document.getElementById('submitButton');
    // const progressBar = document.getElementById('progress-bar');
    // const duration = 5; // Duration in seconds
    // const interval = 100; // Interval in milliseconds

    // let width = 0; // Déplacez la déclaration de width ici
    // let progressIntervalId; // Ajoutez cette ligne
    // let remainingTime = duration; // Ajoutez cette ligne

    // const fillProgressBar = () => {
    //     if (width >= 100) {
    //         console.log(width);
    //         clearInterval(progressIntervalId);
    //         const answers = document.querySelectorAll(".current .answer");
    //         if (answers.length > 0) {
    //             const randomIndex = Math.floor(Math.random() * answers.length);
    //             answers.forEach((answer) => {
    //             const input = answer.getElementsByTagName("input")[0];
    //             const dataIndex = parseInt(input.getAttribute("data-index")); // Convertir en nombre
    //                 if (dataIndex == randomIndex) {
    //                     input.checked = true;
    //                     // Supprimez cette ligne : setInterval(fillProgressBar, interval);
    //                     document.getElementById("nextButton").click();
    //                 }
    //             });
    //         }
    //         // Ajoutez cette ligne :
    //         width = 0;
    //     } else {
    //         // Ajoutez cette ligne :
    //         const increment = (interval / (remainingTime * 1000)) * 100;
    //         // Ajoutez cette condition :
    //         if (width + increment > 100) {
    //             width = 100;
    //         } else {
    //             width += increment;
    //         }
    //         progressBar.style.width = `${width}%`;
    //         // Ajoutez cette ligne :
    //         remainingTime -= interval / 1000;
    //     }
    // };

    function showQuestion(index) {
        if (index >= 0 && index < questions.length) {
            if (index > 0) {
                questions[currentQuestionIndex].style.display = 'none';
            }
            questions[index].style.display = 'block';
            currentQuestionIndex = index;
            currentQuestion = questions[currentQuestionIndex]; // Ajoutez cette ligne
            currentQuestion.classList.add('current');

            // if (progressIntervalId) { // Ajoutez cette ligne
            //     clearInterval(progressIntervalId); // Ajoutez cette ligne
            // }
            // width = 0; // Ajoutez cette ligne
            // // progressIntervalId = setInterval(fillProgressBar, interval);

            if (currentQuestionIndex === questions.length - 1) {
                nextButton.style.display = 'none';
                submitButton.style.display = 'block';
            }
        }
    }

    nextButton.addEventListener('click', function() {
        const radioButtons = currentQuestion.querySelectorAll('input[type=\"radio\"]');
        let answerSelected = false;

        for (const radioButton of radioButtons) {
            if (radioButton.checked) {
                answerSelected = true;
                break;
            }
        }

        if (answerSelected) {
            currentQuestion.classList.remove('current');
            showQuestion(currentQuestionIndex + 1);
            // Ajoutez cette ligne :
            // progressIntervalId = setInterval(fillProgressBar, interval);
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
            modifyBeforeContent(answer, letterValue);
        });
    }

    showQuestion(currentQuestionIndex);
    putLettersOnBefore();
}