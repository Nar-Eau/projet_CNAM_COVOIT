<?php

require_once __DIR__ . '/Database.php';

class AnswerManager
{
    public function getShuffledAnswersByQuestionId(int $questionId): array
    {
        $pdo = Database::getConnection();

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

        // Shuffle the answers
        shuffle($answersData);

        return $answersData;
    }
}