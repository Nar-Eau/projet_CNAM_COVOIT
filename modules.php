<?php
require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/classes/config.php';

if (isset($_GET['id_topic'])) {
    $Id_Topic = $_GET['id_topic'];
    $stmt = $pdo->prepare("SELECT Topics.Name, modules.* 
    FROM Topics
    INNER JOIN modules ON Topics.Id_Topics = modules.Id_Topics
    WHERE Topics.Id_Topics = :Id_Topic"); 
    $stmt->execute(['Id_Topic' => $Id_Topic]);
    $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {    
    header('Location: index.php');
}
?>

<div class="content">
    <div class="headings">
        <div class="page-title">
            Modules pour <?php echo $module['Name'] ?>
        </div>
        <div class="page-description">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae optio cum debitis rerum cupiditate corporis corrupti reprehenderit iusto, harum pariatur numquam ad fugiat, tenetur iste dolor nobis voluptatibus nihil odit.
        </div>
    </div>
</div>

<div class="module-list">

    <?php foreach ($modules as $module):?>
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