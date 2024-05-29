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

<div class="content">
    <div class="headings">
        <div class="page-title">
            Bienvenue sur QuizIt
        </div>
        <div class="page-description">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae optio cum debitis rerum cupiditate corporis corrupti reprehenderit iusto, harum pariatur numquam ad fugiat, tenetur iste dolor nobis voluptatibus nihil odit.
        </div>
    </div>

    <div class="topics-container">
        <div class="topic-item">
            <div class="topic-img">
                <img src="./assets/img/cs.svg" alt="Cybersécurité">
            </div>
            <div class="topic-description">
                <div class="title">Cybersécurité</div>
                <p>Retrouvez des questions autours des modules les plus importants de ce thème : Développement Web, Conteneurisation</p>
            </div>
        </div>
        <div class="topic-item">
            <div class="topic-img">
                <img src="./assets/img/dv.svg" alt="Dévelop">
            </div>
            <div class="topic-description">
                <div class="title">Développement</div>
                <p>Retrouvez des questions autours des modules les plus importants de ce thème : Développement Web, Conteneurisation</p>
            </div>
        </div>
    </div>

    .
</div>

<?php require_once __DIR__ . '/layout/footer.php'; ?>

