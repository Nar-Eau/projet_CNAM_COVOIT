<?php
require_once __DIR__ . '/classes/config.php';

if (isset($_POST['user_id']) && isset($_POST['location'])) {

    //Delete all scores from users
    $sql = "DELETE FROM score_modules WHERE Id_Users = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $_POST['user_id']]);

    //Delete user
    $sql = "DELETE FROM users WHERE Id_Users = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $_POST['user_id']]);

    if ($_POST['location'] == "settings") {
        unset($_SESSION['user_id']);
        header("Location: deconnexion.php");
        exit;
    } else {
        header("Location: adminDashboard.php");
        exit;
    }
}