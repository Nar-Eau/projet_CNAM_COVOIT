<?php

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/../functions/getQuestions.php';
require_once __DIR__ . '/../functions/getQuestionAndAnswersById.php';
require_once __DIR__ . '/../functions/isAnswerCorrect.php';
require_once __DIR__ . '/../functions/getAnswerExplanation.php';


class Quiz
{
    public static function getQuestions(int $moduleId): array {
        return getQuestions($moduleId);
    }

    public static function getQuestionAndAnswersById(int $questionId): array {
        return getQuestionAndAnswersById($questionId);
    }

    public static function isAnswerCorrect(int $answerId): bool {
        return isAnswerCorrect($answerId);
    }

    public static function getAnswerExplanation(int $answerId): string {
        return getAnswerExplanation($answerId);
    }
}
?>