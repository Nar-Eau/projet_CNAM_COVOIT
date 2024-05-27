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

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>



<?php require_once __DIR__ . '/layout/footer.php'; ?>

