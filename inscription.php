<?php
require_once __DIR__ . '/layout/header.php';

require_once __DIR__ . '/classes/config.php';


$message = '';

if (isset($_POST['login']) && isset($_POST['password'])) {
    $name = $_POST['name'];
    $login = $_POST['login'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, login, password, Is_Admin) VALUES (:name, :login, :password, 0)";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute(['name' => $name, 'login' => $login, 'password' => $password]);

    if ($result) {
        $message = 'Inscription réussie!';
        header('Location: connexion.php');
    } else {
        $message = 'Erreur lors de l\'inscription.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        /* Utilisez le même CSS que login.php */
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.login-container {
    max-width: 400px;
    margin: 100px auto;
    background-color: #fff;
    padding: 20px 30px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

h2 {
    margin-top: 0;
    color: #333;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #555;
}

input[type="text"], input[type="password"], input[type="name"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

input[type="submit"] {
    background-color: #007BFF;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

p {
    color: red;
    font-weight: bold;
}

    </style>
</head>
<body>

<div class="login-container">
    <h2>Inscription</h2>

    <?php if (!empty($message)): ?>
        <p style="color:red"><?= $message ?></p>
    <?php endif; ?>

    <form action="inscription.php" method="post">
        <div>
            <label for="name">Nom du client :</label>
            <input type="name" id="name" name="name" required>
        </div>
        <div>
            <label for="login">Pseudo :</label>
            <input type="text" id="login" name="login">
        </div>

        <div>
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password">
        </div>

        <div>
            <input type="submit" value="S'inscrire">
        </div>
    </form>
</div>

</body>
</html>