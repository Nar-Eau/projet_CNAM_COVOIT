<?php

require_once __DIR__ . '/../class/Database.php';

function getAnswerExplanation(int $answerId): string {
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("
        SELECT Description
        FROM Answers
        WHERE Id_Answers = :answerId
    ");
    $stmt->execute(['answerId' => $answerId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? $result['Description'] : 'No explanation available.';
}
?>
