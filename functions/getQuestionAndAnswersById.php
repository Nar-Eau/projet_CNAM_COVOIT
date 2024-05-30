<?php

require_once __DIR__ . '/../classes/Database.php';

function getQuestionAndAnswersById(int $questionId): array {
    $pdo = Database::getConnection();

    // Get the question text
    $stmt = $pdo->prepare("
        SELECT Id_Questions, Question
        FROM Questions
        WHERE Id_Questions = :questionId
    ");
    $stmt->execute(['questionId' => $questionId]);
    $questionData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$questionData) {
        throw new Exception("Question not found.");
    }

    // Get the answers for the selected question
    $stmt = $pdo->prepare("
        SELECT Id_Answers, Answer
        FROM Answers
        WHERE Id_Questions = :questionId
    ");
    $stmt->execute(['questionId' => $questionId]);
    $answersData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($answersData) !== 4) {
        throw new Exception("There should be exactly 4 answers for the question.");
    }

    $question = [
        'id' => $questionData['Id_Questions'],
        'text' => $questionData['Question'],
        'answers' => []
    ];

    foreach ($answersData as $row) {
        $question['answers'][] = [
            'id' => $row['Id_Answers'],
            'text' => $row['Answer']
        ];
    }

    return $question;
}
?>
