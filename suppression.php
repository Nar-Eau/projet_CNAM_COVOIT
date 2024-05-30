<?php

require_once __DIR__ . '/layout/header.php';

require_once __DIR__ . '/classes/config.php';

session_start();

$user_id = $_SESSION['user_id'];

$sql = "DELETE FROM users WHERE Id_Users = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
unset($_SESSION['user_id']);
session_destroy();

header("deconnexion.php");