<?php

require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/getQuestionAndAnswersById.php';

function getQuestions($connection) {

    $id = (int) $_GET['id'];

    if (isset($_GET['selection'])) {
        // Logique pour obtenir 40 questions pour un sujet
        $stmt = $connection->prepare("
        SELECT q.* FROM questions q
        JOIN modules m ON q.Id_Modules = m.Id_Modules
        WHERE m.Id_Topics = :id
        ORDER BY RAND()
        LIMIT 40
        ");
    } else {
        session_start();
        $_SESSION['Id_Modules'] = $id;
        $stmt = $connection->prepare("
            SELECT * FROM questions 
            WHERE Id_Modules = :id 
            ORDER BY RAND()
            LIMIT 10
        ");
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