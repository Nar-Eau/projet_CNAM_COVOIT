<?php
require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/classes/Database.php';

try {
    // Obtenir la connexion à la base de données
    $connection = Database::getConnection();
    // Utiliser $connection pour interagir avec la base de données
} catch (Exception $e) {
    // Gérer les erreurs de connexion
    echo $e->getMessage();
}
?>

<h1 class="headings">QuizIT</h1>

<div class="topics-container">
    
</div>

<?php require_once __DIR__ . '/layout/footer.php'; ?>

