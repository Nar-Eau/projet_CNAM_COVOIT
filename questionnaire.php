<?php
require_once './layout/header.php';
require_once './classes/Database.php';

if (isset($_GET['id_quizz'])) {
    $number = $_GET['id_quizz'];
    echo "Le chiffre envoyé est : " . htmlspecialchars($number);
} else {
    echo "Aucun chiffre n'a été envoyé.";
}

?>

<form method='POST' action='.php'>
        <legend><b>Question:</b></legend>
        <h1>What is your favorite color ?</h1>
    <table>
        <tr>
            <th><input type='radio' name='choix' value='response1'> A - <br></th>
            <th>Blabla</th>
            <th><input type='radio' name='choix' value='response1'> B - <br></th>
            <th>Blableu</th>
        </tr>
        <tr>
            <th><input type='radio' name='choix' value='response2'> C -<br></th>
            <th>Blableu</th>
            <th><input type='radio' name='choix' value='response3'> D - <br></th>
            <th>Blableu</th>
        </tr>
    </table>
    <br><input type='submit' name='Valider' value='Enregistrer ma réponse'>
</form>

<?php    require_once './layout/footer.php';