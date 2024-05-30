<?php

require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/getQuestionAndAnswersById.php';

function getQuestions($connection) {
    if (!isset($_GET['id'])) {
        return [];
    }

    $id = (int) $_GET['id'];
    // Logique pour obtenir 10 questions aléatoires pour un module
    $stmt = $connection->prepare("
        SELECT * FROM Questions 
        WHERE Id_Modules = :id 
        ORDER BY RAND()
        LIMIT 10
    ");


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