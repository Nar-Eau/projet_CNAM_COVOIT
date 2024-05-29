<?php

require_once __DIR__ . '/../class/Database.php';
require_once __DIR__ . '/Quiz.php';


$correctAnswers = $_SESSION['correctAnswers'];
$totalQuestions = count($_SESSION['questions']);
$userAnswers = $_SESSION['userAnswers'];

include __DIR__ . '/../includes/header.php';
?>

<div class="results">
    <h2>Quiz Completed!</h2>
    <p>You answered <?php echo $correctAnswers; ?> out of <?php echo $totalQuestions; ?> questions correctly.</p>
    <h3>Review Your Answers</h3>
    <ol>
        <?php foreach ($userAnswers as $userAnswer): ?>
            <li>
                <strong><?php echo htmlspecialchars($userAnswer['question']); ?></strong><br>
                <?php if ($userAnswer['correct']): ?>
                    <span style="color: green;">Your answer was correct.</span>
                <?php else: ?>
                    <span style="color: red;">Your answer was incorrect.</span><br>
                    <strong>Explanation:</strong> <?php echo htmlspecialchars(Quiz::getAnswerExplanation($userAnswer['correctAnswerId'])); ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
    <a href="/index.php">Go to Home</a>
</div>

<?php
// Clear the session data after displaying the results
session_destroy();
include __DIR__ . '/../includes/footer.php';
?>
