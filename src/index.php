<?php
$champs = [
    "champ1", "champ2", "champ3", "champ4", "champ5",
    "champ6", "champ7", "champ8", "champ9", "champ10"
];

$champAleatoire = null;
$valeur = null;

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["submit"])) {

    // Tirage aléatoire d'un champ
    $champAleatoire = $champs[array_rand($champs)];

    // Récupération de la valeur saisie dans ce champ
    if (isset($_GET[$champAleatoire])) {
        $valeur = $_GET[$champAleatoire];
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

</body>
</html>
