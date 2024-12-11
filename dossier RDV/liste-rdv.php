<?php
require_once '../utils/connect_db.php';


$sql = "SELECT appointments.id AS rdv_id, appointments.dateHour, patients.id AS patient_id, patients.firstname, patients.lastname, patients.birthdate, patients.phone, patients.mail
        FROM appointments
        JOIN patients ON appointments.idPatients = patients.id";

try {
  
    $stmt = $objetPdo->query($sql);
    $rdvs = $stmt->fetchAll(PDO::FETCH_ASSOC); 
} catch (PDOException $error) {
    echo "Erreur lors de la récupération des rendez-vous : " . $error->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Rendez-vous</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <h2>Liste des rendez-vous</h2>

    <?php foreach ($rdvs as $rdv): ?>
        <div class="rdv-card">
          
        
        <p><strong>Nom :</strong> <?= htmlspecialchars($rdv['lastname']) ?></p>
        <p><strong>Prénom :</strong> <?= htmlspecialchars($rdv['firstname']) ?></p>
            <p><strong>Date et Heure:</strong> <?= htmlspecialchars($rdv['dateHour']) ?></p>
            <p><strong>ID du Patient:</strong> <?= htmlspecialchars($rdv['patient_id']) ?></p>
           
          
            <a href="rendezvous.php?id=<?= $rdv['rdv_id'] ?>">Voir les détails</a>
            <hr>
        </div>
    <?php endforeach; ?>
<a href="./ajout-rdv.php">Créer un nouveau rdv</a>
</body>
</html>
