<?php
require_once __DIR__ . '/../classes/Database.php';

function getAnswerExplanation(PDO $connection, int $answerId , int $questionId): string {
    $stmt = $connection->prepare("
        SELECT Description
        FROM answers a 
        where valid_answer = 1 AND Id_questions = $questionId
    ");

$stmt->execute(/*['id' => $answerId]*/);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result && isset($result['Description'])) {
        
        return $result['Description'];
    } else {
        return ''; // Retourne une chaîne vide si aucune explication n'est trouvée
    }
}
?>