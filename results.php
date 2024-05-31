<?php
session_start();
require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/functions/isAnswerCorrect.php';
require_once __DIR__ . '/functions/getAnswerExplanation.php';
require_once __DIR__ . '/classes/config.php';


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

if (isset($_SESSION['Id_Modules'])) {
    $Id_Modules = $_SESSION['Id_Modules'];
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM score_modules WHERE score_modules.Id_Users = :user_id AND score_modules.Id_Modules = :Id_Modules";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id, 'Id_Modules' => $Id_Modules]);
    $scores = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($scores["Score"] < $correctAnswers) {
        $sql = "DELETE FROM score_modules WHERE score_modules.Id_Users = :user_id AND score_modules.Id_Modules = :Id_Modules";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute(['user_id' => $user_id, 'Id_Modules' => $Id_Modules]);
    
        $sql = "INSERT INTO score_modules (Id_Modules, Id_Users, Score) VALUES (:Id_Modules, :user_id, :score)";
        $stmt = $pdo->prepare($sql);
        $score = $stmt->execute(['Id_Modules' => $Id_Modules, 'user_id' => $user_id, 'score' => $correctAnswers]);
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
    $stmt = $connection->prepare("SELECT * FROM questions WHERE Id_Questions = :id");
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