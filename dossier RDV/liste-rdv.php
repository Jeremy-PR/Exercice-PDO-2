<?php
require_once '../utils/connect_db.php';

$sql = "SELECT * FROM `appointments`";

try {
    $stmt = $objetPdo->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC); // ou fetch si vous savez que vous n'allez avoir qu'un seul résultat

} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h1>Liste des utilisateurs :</h1>

        <div class="user-list">
            <?php
            foreach ($users as $user) {
            ?>
                <div class="user-item">
                    <p><span>Nom :</span> <?= $user['lastname'] ?></p>
                    <p><span>Prénom :</span> <?= $user['firstname'] ?></p>
                    <p><span>Date de naissance :</span> <?= $user['birthdate'] ?></p>
                    <p><span>Téléphone :</span> <?= $user['phone'] ?></p>
                    <p><span>Mail :</span> <?= $user['mail'] ?></p>
                    <a href="../profil-patient.php?id=<?= $user['id'] ?>">Voir Profil</a>
                </div>

                
            <?php
            }
            ?>
        </div>
    </div>
    <a href="../dossier RDV/ajout-rdv.php"> Liste des rdv</a>
</body>

</html>