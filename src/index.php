<?php
// Connexion à la base de données MySQL
$host = "localhost:3306"; // Nom du service dans docker-compose.yml
$db = "maint-applic-td1";
$user = "root";
$pass = "";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$pdo = null;

// Skip database connection in testing mode
if (!defined("TESTING") || TESTING !== true) {
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}

$champs = ["champ1", "champ2", "champ3", "champ4", "champ5", "champ6", "champ7", "champ8", "champ9", "champ10"];

$champAleatoire = null;
$valeur = null;

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["submit"])) {
    // Tirage aléatoire d'un champ
    $champAleatoire = $champs[array_rand($champs)];

    // Récupération de la valeur saisie dans ce champ
    if (isset($_GET[$champAleatoire])) {
        $valeur = $_GET[$champAleatoire];

        // Insertion dans la base de données (skip in testing mode)
        if ($pdo !== null) {
            $stmt = $pdo->prepare("INSERT INTO resultats (champ_selectionne, valeur_saisie) VALUES (?, ?)");
            $stmt->execute([$champAleatoire, $valeur]);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h2>Édité par</h2>
    <ul>
        <li>MICALLEF John</li>
        <li>AHOUANDOGBO Amen</li>
        <li>SCHEER Corentin</li>
        <li>OGER Gabriel</li>
    </ul>
    <br />

<?php if ($champAleatoire): ?>
    <h2>Champ sélectionné : <?= $champAleatoire ?></h2>
    <h3>Valeur saisie : <?= htmlspecialchars($valeur) ?></h3>
<?php endif; ?>


<form action="" method="GET">
    <label for="champ1">Champ1 :</label>
    <input type="text" id="champ1" name="champ1">
    <br><br>

    <label for="champ2">Champ2 :</label>
    <input type="text" id="champ2" name="champ2">
    <br><br>

    <label for="champ3">Champ3 :</label>
    <input type="text" id="champ3" name="champ3">
    <br><br>

    <label for="champ4">Champ4 :</label>
    <input type="text" id="champ4" name="champ4">
    <br><br>

    <label for="champ5">Champ5 :</label>
    <input type="text" id="champ5" name="champ5">
    <br><br>

    <label for="champ6">Champ6 :</label>
    <input type="text" id="champ6" name="champ6">
    <br><br>

    <label for="champ7">Champ7 :</label>
    <input type="text" id="champ7" name="champ7">
    <br><br>

    <label for="champ8">Champ8 :</label>
    <input type="text" id="champ8" name="champ8">
    <br><br>

    <label for="champ9">Champ9 :</label>
    <input type="text" id="champ9" name="champ9">
    <br><br>

    <label for="champ10">Champ10 :</label>
    <input type="text" id="champ10" name="champ10">
    <br><br>

    <input type="submit" name="submit" value="Envoyer">
</form>
<style>
        body {
            color: white;
            background-image: url('img/faker.webp');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</body>
</html>
