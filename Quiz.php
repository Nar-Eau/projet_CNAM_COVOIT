<?php
require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/functions/getQuestions.php';

// Connexion à la base de données
$connection = Database::getConnection();

// Appeler la fonction getQuestions avec la connexion à la base de données
$questions = getQuestions($connection);
?>



<?php
// Afficher les questions sous forme de quizz interactif
if (!empty($questions)) { ?>
    <form id='quizForm' method='POST' action='Results.php'>
    
    <?php
    foreach ($questions as $index => $question) {
    ?>
        <div class='question-container' id='question_" . $index . "' style='display: none;'>
            <div class="question">Question <?php echo ($index + 1) . ": " . htmlspecialchars($question['Question']) ?> </div>
                <div class="answer">
                    <?php
                    // Obtenir les réponses pour cette question
                    $stmt = $connection->prepare("SELECT * FROM answers WHERE Id_Questions = :id");
                    $stmt->execute(['id' => $question['Id_Questions']]);
                    $answers = $stmt->fetchAll();

                    if (!empty($answers)) {
                        foreach ($answers as $index => $answer) {
                            ?>
                            <label>
                            <input type='radio' name='answer_<?php echo $question['Id_Questions'] ?>' value='<?php echo htmlspecialchars($answer['Id_Answers']) ?>' data-index='<?php echo $index?>'>
                            <p>
                                <?php
                                echo htmlspecialchars($answer['Answer'])
                                ?>
                            </p>
                            </label>
                            <?php
                        }
                    }
                    ?>
                </div>
        </div>
        <?php
    }?>
    <div class="button-container">
        <button id='nextButton' type='button'>Question Suivante</button>
        <button id='submitButton' type='submit' style='display: none;'>Soumettre</button>
    </div>
    </form>

    <?php
}

?>

<?php require_once __DIR__ . '/layout/footer.php'; ?>