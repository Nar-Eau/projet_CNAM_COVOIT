<?php

require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/classes/config.php';

// Récupérer les utilisateurs
$query = "SELECT Id_Users, Name, Login FROM users";
$stmt = $pdo->query($query);
$users = $stmt->fetchAll();
?>

<div class="content">
    <div class="headings">
            <div class="page-title">
                Liste des Utilisateurs
            </div>
            <div class="page-description">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae optio cum debitis rerum cupiditate corporis corrupti reprehenderit iusto, harum pariatur numquam ad fugiat, tenetur iste dolor nobis voluptatibus nihil odit.
            </div>
        </div> 
    <div class="table-container">
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
                <?php foreach ($users as $user) : ?>
                    <tr data-id="<?php echo htmlspecialchars($user['Id_Users']); ?>">
                        <td><?php echo htmlspecialchars($user['Id_Users']); ?></td>
                        <td><?php echo htmlspecialchars($user['Name']); ?></td>
                        <td><?php echo htmlspecialchars($user['Login']); ?></td>
                        <td>
                            <form id="deleteForm" action="suppression.php" method="post" style="display:inline;">
                                <input type="hidden" id="user_id" name="user_id" value="<?php echo htmlspecialchars($user['Id_Users']); ?>">
                                <input type="hidden" id="location" name="location" value="adminDashboard">
                                <button type="submit" class="delete-button" onclick="confirmDelete()">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="scores-container" class="scores-container"></div>
</div>


<?php require_once __DIR__ . '/layout/footer.php'; ?>
