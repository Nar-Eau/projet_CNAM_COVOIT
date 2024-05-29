<?php
require_once './layout/header.php';
require_once './classes/Database.php';
?>
<div class="container">
    <div class="cards-Cyber">
        <fieldset>
            <h2>Cybersécurité</h2>
            <img src="" alt="Image de cybersécurité">
            <div class="content">
                La cybersécurité est l'ensemble des techniques, 
                pratiques et mesures mises en place pour protéger les systèmes 
                informatiques, les réseaux et les données contre les attaques,
                les accès non autorisés, les dommages et les destructions. 
                Elle vise à assurer la confidentialité, l'intégrité et la 
                disponibilité des informations numériques.
                <br><br>
                <button onclick="launchQuiz('cybersecurity')">Lancer le quiz Cybersécurité</button>
            </div>
        </fieldset>
    </div>
    <div class="cards-Dev">
        <fieldset>
            <h2>Développement</h2>
            <img src="" alt="Image de développement">
            <div class="content">
                Le développement informatique est le processus de conception, de création, de test et de maintenance des applications et des logiciels. Il englobe la programmation, l'écriture de code source, l'élaboration d'algorithmes, ainsi que l'utilisation de divers outils et technologies pour créer des solutions informatiques répondant à des besoins spécifiques.
                <br><br>
                <button onclick="launchQuiz('development')">Lancer le quiz Développement</button>
            </div>
        </fieldset>
    </div>
</div>



<?php    require_once './layout/footer.php';