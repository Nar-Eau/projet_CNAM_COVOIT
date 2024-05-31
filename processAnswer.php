<?php
require_once __DIR__ . '/../class/createQuiz.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $answerId = $_POST['answerId'];

    try {
        if (Quiz::isAnswerCorrect($answerId)) {
            $message = 'Correct!';
        } else {
            $message = 'Incorrect!';
        }
    } catch (Exception $e) {
        $message = 'Error: ' . $e->getMessage();
    }
} else {
    $message = 'Invalid request method.';
}

include __DIR__ . '/../includes/header.php';
?>

<div class="result">
    <?php echo htmlspecialchars($message); ?>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
