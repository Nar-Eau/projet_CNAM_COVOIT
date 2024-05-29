<?php
session_start();
require_once __DIR__ . '/../class/createQuiz.php';
require_once __DIR__ . '/../class/AnswerManager.php';
require_once __DIR__ . '/../class/Database.php';

$moduleId = 1; // Remplacez par l'ID du module réel que vous voulez utiliser
$feedback = '';

if (!isset($_SESSION['questions'])) {
    try {
        $quiz = new Quiz();
        $_SESSION['questions'] = $quiz->getQuestions($moduleId);
        $_SESSION['currentQuestionIndex'] = 0;
        $_SESSION['correctAnswers'] = 0;
        $_SESSION['userAnswers'] = [];
        $_SESSION['showResultButton'] = false;
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['answerId'])) {
        $answerId = $_POST['answerId'];
        $currentQuestionIndex = $_SESSION['currentQuestionIndex'];
        $isCorrect = Quiz::isAnswerCorrect($answerId);

        if ($isCorrect) {
            $_SESSION['correctAnswers']++;
            $feedback = 'Correct!';
        } else {
            $feedback = 'Incorrect!';
        }

        $_SESSION['userAnswers'][] = [
            'question' => $_SESSION['questions'][$currentQuestionIndex]['text'],
            'correct' => $isCorrect,
            'selectedAnswerId' => $answerId,
            'correctAnswerId' => array_filter($_SESSION['questions'][$currentQuestionIndex]['answers'], fn($answer) => Quiz::isAnswerCorrect($answer['id']))[0]['id']
        ];

        $currentQuestionIndex++;
        if ($currentQuestionIndex >= count($_SESSION['questions'])) {
            $_SESSION['showResultButton'] = true;
        } else {
            $_SESSION['currentQuestionIndex'] = $currentQuestionIndex;
        }
    } elseif (isset($_POST['viewResults'])) {
        header('Location: Results.php');
        exit();
    }
}

$currentQuestion = $_SESSION['questions'][$_SESSION['currentQuestionIndex']] ?? null;
$showResultButton = $_SESSION['showResultButton'];

include __DIR__ . '/../includes/header.php';

$answerManager = new AnswerManager();
$answers = $answerManager->getShuffledAnswersByQuestionId($currentQuestion['id']);
?>

<div class="quiz">
    <div class="timer">
        Question <?php echo $_SESSION['currentQuestionIndex'] + 1; ?> sur 40
    </div>
    <?php if ($currentQuestion): ?>
    <div class="question">
        <?php echo htmlspecialchars($currentQuestion['text']); ?>
    </div>
    <form method="POST" action="">
        <div class="answers">
            <?php foreach ($answers as $answer): ?>
                <button type="submit" name="answerId" value="<?php echo $answer['Id_Answers']; ?>">
                    <?php echo htmlspecialchars($answer['Answer']); ?>
                </button>
            <?php endforeach; ?>
        </div>
    </form>
    <?php if ($feedback): ?>
        <div class="feedback">
            <?php echo htmlspecialchars($feedback); ?>
        </div>
    <?php endif; ?>
    <?php endif; ?>
    <?php if ($showResultButton): ?>
    <form method="POST" action="">
        <button type="submit" name="viewResults">Voir les résultats</button>
    </form>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
