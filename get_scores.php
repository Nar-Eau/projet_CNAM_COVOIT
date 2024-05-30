<?php

require_once __DIR__ . '/classes/config.php';

// Vérifier si l'ID de l'utilisateur est passé en paramètre
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Récupérer les scores des modules pour l'utilisateur
    $query = "
        SELECT m.Name AS module_name, sm.Score AS score
        FROM Score_modules sm
        JOIN Modules m ON sm.Id_Modules = m.Id_Modules
        WHERE sm.Id_Users = :id
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $user_id]);
    $scores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Renvoyer les scores en JSON
    header('Content-Type: application/json');
    echo json_encode($scores);
} else {
    echo json_encode([]);
}
?>
