<?php

require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/getQuestionAndAnswersById.php';

function getQuestions($connection) {
    if (!isset($_GET['selection']) || !isset($_GET['id'])) {
        return [];
    }

    $selection = $_GET['selection'];
    $id = (int) $_GET['id'];

    if ($selection === 'module') {
        // Logique pour obtenir 10 questions aléatoires pour un module
        $stmt = $connection->prepare("
            SELECT * FROM Questions 
            WHERE Id_Modules = :id 
            ORDER BY RAND()
            LIMIT 10
        ");
    } elseif ($selection === 'topic') {
        // Logique pour obtenir 40 questions pour un sujet
        $stmt = $connection->prepare("
            SELECT q.* FROM Questions q
            JOIN Modules m ON q.Id_Modules = m.Id_Modules
            WHERE m.Id_Topics = :id
            ORDER BY RAND()
            LIMIT 40
        ");
    } else {
        return [];
    }

    $stmt->execute(['id' => $id]);
    $questions = $stmt->fetchAll();

    return $questions;
}

// Vérifier si une connexion est établie à la base de données
try {
    $connection = Database::getConnection();
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit();
}

?>