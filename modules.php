<?php
require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/classes/config.php';

if (isset($_GET['id_topic'])) {
    $Id_Topic = $_GET['id_topic'];
    $stmt = $pdo->prepare("SELECT * FROM modules WHERE Id_Topics = :Id_Topic"); 
    $stmt->execute(['Id_Topic' => $Id_Topic]);
    $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {    
    header('Location: index.php');
}
?>

<h1>Modules</h1>


<div class="module-list" style="display: ruby">

    <?php foreach ($modules as $module): ?>
        <div class="module-container">
            <h2><?php echo $module['Name'] ; ?></h2>
            
            <div>
                <label for="score"><b>Score :</b><?php echo number_format($module['Id_Modules'], 2); ?></label>
            </div>
            
            
            <div>
            <form action="questionnaire.php" method="get">
                <button type="submit" name="id_quizz" value=<?php echo $module['Id_Modules']; ?>>test</button>
            </form>
            </div>
        </div>
        <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/layout/footer.php'; ?>