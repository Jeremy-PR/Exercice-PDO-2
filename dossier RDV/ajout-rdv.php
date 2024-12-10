<?php
require_once '../utils/connect_db.php';

if (isset($_GET['rdv'])) {

    $idRdv = $_GET['rdv'];

    $sql = "SELECT * FROM appointments WHERE id = :id";

    try {
        $stmt = $objetPdo->prepare($sql);
        $stmt->execute(['id' => $idRdv]);
        $rdv = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo "Erreur lors de la requête : " . $error->getMessage();
    }
} else {
    die('ID Invalide ou non spécifié');
}




?>








<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre un RDV</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <h2>Prendre un rendez-vous</h2>


    <form method="post" action="./process-ajour-rdv.php">

       
       

      
        <div class="rowTab3"> 
            <div class="labels3">
                <label>Choisir une date et une heure :</label>
            </div>
            <div class="rightTab3">
                <input type="date" name="jour" class="input-field" required>
                <input type="time" name="heure" min="09:00" max="18:00" required>
            </div>     
        </div>

        <button class="action-button animate red">Soumettre</button>
        <a href="../index.php">Retour à l'accueil</a>
    </form>

</body>
</html>
