<?php
require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/functions/getQuestions.php';

// Connexion à la base de données
$connection = Database::getConnection();

// Appeler la fonction getQuestions avec la connexion à la base de données
$questions = getQuestions($connection);

// Afficher les questions sous forme de quizz interactif
if (!empty($questions)) {
    echo "<form id='quizForm' method='POST' action='Results.php'>";
    foreach ($questions as $index => $question) {
        echo "<div class='question' id='question_" . $index . "' style='display: none;'>";
        echo "<p>Question " . ($index + 1) . ": " . htmlspecialchars($question['Question']) . "</p>";
        // Obtenir les réponses pour cette question
        $stmt = $connection->prepare("SELECT * FROM Answers WHERE Id_Questions = :id");
        $stmt->execute(['id' => $question['Id_Questions']]);
        $answers = $stmt->fetchAll();

        if (!empty($answers)) {
            foreach ($answers as $answer) {
                echo "<label>";
                echo "<input type='radio' name='answer_" . $question['Id_Questions'] . "' value='" . htmlspecialchars($answer['Id_Answers']) . "'>";
                echo htmlspecialchars($answer['Answer']);
                echo "</label><br>";
            }
        }
        echo "</div>";
    }
    echo "<button id='nextButton' type='button'>Question Suivante</button>";
    echo "<button id='submitButton' type='submit' style='display: none;'>Soumettre</button>";
    echo "</form>";

    // JavaScript pour afficher les questions une par une
    echo "<script>
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
    </script>";
} else {
    echo "Aucune question trouvée.";
}

require_once __DIR__ . '/layout/footer.php';
?>
