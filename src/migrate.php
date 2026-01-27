<?php 
// Connexion à la base de données MySQL
$host = 'localhost:3306';  // Nom du service dans docker-compose.yml
$db = 'maint-applic-td1';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$sql = "CREATE TABLE IF NOT EXISTS migrations (id VARCHAR(255) PRIMARY KEY, date DATETIME DEFAULT CURRENT_TIMESTAMP)";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$migrationsJson = file_get_contents('migrations.json');
$migrations = json_decode($migrationsJson, true);

if ($migrations === null) {
    die("Erreur de lecture ou de décodage du fichier JSON");
}

foreach ($migrations as $migration) {
    $id = $migration['id'];

    $stmt = $pdo->prepare("SELECT id FROM migrations WHERE id = ?");
    $stmt->execute([$id]);
    $exists = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$exists) {
        echo "Exécution de la migration : $id\n";

        foreach ($migration['scripts'] as $script) {
            try {
                $pdo->exec($script);
            } catch (PDOException $e) {
                echo "Erreur lors de l'exécution du script : " . $e->getMessage() . "\n";
                continue;
            }
        }

        $stmt = $pdo->prepare("INSERT INTO migrations (id) VALUES (?)");
        $stmt->execute([$id]);
        echo "Migration enregistrée : $id\n";
    } else {
        echo "Migration déjà exécutée : $id\n";
    }
}