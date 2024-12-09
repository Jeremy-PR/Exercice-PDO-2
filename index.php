<?php
require_once './connect_db.php';

$sql = "SELECT * FROM `patients`";

try {
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC); // ou fetch si vous savez que vous n'allez avoir qu'un seul résultat

} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}


?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'ajout d'un patient</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Formulaire d'ajout d'un patient</h1>
 <a href="./ajout-patient.php">Cliquer ici pour créer un nouveau profil patient</a>
</body>
</html>