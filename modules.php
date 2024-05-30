<?php
require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/classes/config.php';


?>

<h1>Modules</h1>

<?php
$stmt = $pdo->prepare("SELECT * FROM modules");
$stmt->execute();
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($modules === false) {
    echo "test";
    return null;
}

?>

<div class="module-list" style="display: ruby">

    <?php foreach ($modules as $module): ?>
        <div class="module-container">
            <h2><?php echo $module['Name'] ; ?></h2>
            
            <div>
                <label for="score"><b>Score :</b><?php echo number_format($module['Id_Modules'], 2); ?></label>
            </div>
            
            
            <div>
                <input type="submit" value="Accéder">
            </div>
        </div>
        <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/layout/footer.php'; ?>