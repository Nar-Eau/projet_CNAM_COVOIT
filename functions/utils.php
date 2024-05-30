<?php
function redirect(string $location): never
{
    header('Location: ' . $location);
    exit;
}

function testLogin()
{
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php');
        exit;
    }
    return $_SESSION['user_id'];
}