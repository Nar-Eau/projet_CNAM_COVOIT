<?php

require_once __DIR__ . '/layout/header.php';

require_once __DIR__ . '/classes/config.php';

if (isset($_POST['user_id']) && isset($_POST['location'])) {

    echo $_POST['user_id'];
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
