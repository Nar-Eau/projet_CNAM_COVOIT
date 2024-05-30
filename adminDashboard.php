<?php

require_once __DIR__ . '/layout/header.php';

require_once __DIR__ . '/classes/config.php';

// Récupérer les utilisateurs
$query = "SELECT Id_Users, Name, Login FROM users";
$stmt = $pdo->query($query);
$users = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .table-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            cursor: pointer;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .delete-button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #ff1a1a;
        }

        .scores-container {
            margin-top: 30px;
        }
    </style>
    <script src="script.js" defer></script>
</head>
<body>
    <div class="table-container">
        <h2>Liste des utilisateurs</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Pseudo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr data-id="<?php echo htmlspecialchars($user['Id_Users']); ?>">
                        <td><?php echo htmlspecialchars($user['Id_Users']); ?></td>
                        <td><?php echo htmlspecialchars($user['Name']); ?></td>
                        <td><?php echo htmlspecialchars($user['Login']); ?></td>
                        <td>
                            <form action="suppression.php" method="get" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['Id_Users']); ?>">
                                <button type="submit" class="delete-button">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div id="scores-container" class="scores-container"></div>
</body>
</html>
