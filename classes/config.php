<?php
[
    'HOST' => $dbHost,
    'DB_NAME' => $dbName,
    'CHARSET' => $dbCharset,
    'USER' => $dbUser,
    'PASSWORD' => $dbPassword
] = parse_ini_file(__DIR__ . '/../config/db.ini');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=$dbCharset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// try {
//      $pdo = new PDO($dsn, $dbUser, $dbPassword, [
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//         PDO::ATTR_PERSISTENT => true
//      ]);
// } catch (\PDOException $e) {
//     echo "oui";
//      throw new \PDOException($e->getMessage(), (int)$e->getCode());
// }

try {
    // Crée une nouvelle instance PDO avec des options
    $pdo = new PDO($dsn, $dbUser, $dbPassword, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_PERSISTENT => true
     ]);
} catch (PDOException $e) {
    // Gestion des erreurs de connexion
    throw new Exception("Connection failed: " . $e->getMessage());
}
?>