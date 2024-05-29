<?php

require_once __DIR__ . '/../class/Database.php';

function isAnswerCorrect(int $answerId): bool {
    $pdo = Database::getConnection();

    $stmt = $pdo->prepare("
        SELECT valid_answer
        FROM Answers
        WHERE Id_Answers = :answerId
    ");
    $stmt->execute(['answerId' => $answerId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return (bool)$result['valid_answer'];
    } else {
        throw new Exception("Invalid answer selected.");
    }
}
?>
