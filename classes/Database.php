<?php
class Database
{
    // Instance unique de PDO
    private static ?PDO $instance = null;

    // Constructeur privé pour empêcher l'instanciation directe
    private function __construct() {}

    // Méthode statique pour obtenir la connexion PDO
    public static function getConnection(): PDO
    {
        // Vérifie si l'instance est déjà créée
        if (self::$instance === null) {
            // Charge la configuration depuis le fichier INI
            [
                'HOST' => $dbHost,
                'MYSQL' => $dbName,
                'CHARSET' => $dbCharset,
                'USER' => $dbUser,
                'PASSWORD' => $dbPassword
            ] = parse_ini_file(__DIR__ . '/../config/db.ini');
            
            // Data Source Name (DSN)
            $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=$dbCharset";


            try {
                // Crée une nouvelle instance PDO avec des options
                self::$instance = new PDO($dsn, $dbUser, $dbPassword, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_PERSISTENT => true
                ]);
            } catch (PDOException $e) {
                // Gestion des erreurs de connexion
                throw new Exception("Connection failed: " . $e->getMessage());
            }
        }

        // Retourne l'instance unique
        return self::$instance;
    }
}
