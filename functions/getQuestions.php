<?php

require_once __DIR__ . '/../class/Database.php';
require_once __DIR__ . '/getQuestionAndAnswersById.php';

function getQuestions(int $moduleId): array {
    $pdo = Database::getConnection();

    // Get 40 random questions for the given module
    $stmt = $pdo->prepare("
        SELECT q.Id_Questions
        FROM Questions q
        WHERE q.Id_Modules = :moduleId
        ORDER BY RAND()
        LIMIT 40
    ");
    $stmt->execute(['moduleId' => $moduleId]);
    $questionsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($questionsData) !== 40) {
        throw new Exception("Could not retrieve 40 questions for the specified module.");
    }

    $questions = [];
    foreach ($questionsData as $questionData) {
        $questions[] = getQuestionAndAnswersById($questionData['Id_Questions']);
    }

    return $questions;
}
?>
