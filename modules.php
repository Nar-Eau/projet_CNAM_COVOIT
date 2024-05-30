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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.module-container {
    width: 400px;
    height: 150px;
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

input[type="text"], input[type="password"] {
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