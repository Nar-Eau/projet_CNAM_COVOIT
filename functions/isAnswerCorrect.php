<?php
require_once __DIR__ . '/../classes/Database.php';

function isAnswerCorrect(PDO $connection, int $answerId): bool {
    $stmt = $connection->prepare("SELECT valid_answer FROM Answers WHERE Id_Answers = :id");
    $stmt->execute(['id' => $answerId]);
    $answer = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $answer ? (bool)$answer['valid_answer'] : false;
}

?>