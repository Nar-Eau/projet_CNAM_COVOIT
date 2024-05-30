<?php
session_start();
require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/functions/isAnswerCorrect.php';
require_once __DIR__ . '/functions/getAnswerExplanation.php';

// Connexion à la base de données
$connection = Database::getConnection();

// Traitement des réponses soumises
$questions = $_POST;
$correctAnswers = 0;
$totalQuestions = count($questions);
$results = [];

foreach ($questions as $key => $answerId) {
    if (strpos($key, 'answer_') === 0) {
        $questionId = str_replace('answer_', '', $key);
        $isCorrect = isAnswerCorrect($connection, (int)$answerId);
        $explanation = getAnswerExplanation($connection, $answerId, $questionId);

        $results[] = [
            'questionId' => $questionId,
            'answerId' => $answerId,
            'isCorrect' => $isCorrect,
            'explanation' => $explanation
        ];

        if ($isCorrect) {
            $correctAnswers++;
        }
    }
}

// Calcul du score
$score = ($correctAnswers / $totalQuestions) * 100;

// Afficher les résultats
require_once __DIR__ . '/layout/header.php';
?>
<h1>Résultats du Quiz</h1>
<p>Votre score: <?= $correctAnswers ?> / <?= $totalQuestions ?> (<?= $score ?>%)</p>

<h2>Détails des réponses:</h2>
<?php foreach ($results as $result): ?>
    <?php
    $stmt = $connection->prepare("SELECT * FROM Questions WHERE Id_Questions = :id");
    $stmt->execute(['id' => $result['questionId']]);
    $question = $stmt->fetch();
    ?>

    <div>
        <p>Question: <?= htmlspecialchars($question['Question']) ?></p>

        <?php if ($result['isCorrect']): ?>
            <p>Votre réponse: Correct</p>
        <?php else: 
            
            ?>
            <p>Votre réponse: Incorrect</p>
            <p>Explication: <?= htmlspecialchars($result['explanation']) ?></p>
        <?php endif; ?>
    </div>
    <hr>
<?php endforeach; ?>

<?php require_once __DIR__ . '/layout/footer.php'; ?>