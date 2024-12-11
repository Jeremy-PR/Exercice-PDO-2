<?php
require_once '../utils/connect_db.php';

// Vérifier si l'ID est présent dans l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $rdv_id = $_GET['id'];

    // Requête SQL pour récupérer les détails du rendez-vous spécifique
    $sql = "SELECT appointments.id AS rdv_id, appointments.dateHour, patients.id AS patient_id, patients.firstname, patients.lastname, patients.birthdate, patients.phone, patients.mail
            FROM appointments
            JOIN patients ON appointments.idPatients = patients.id
            WHERE appointments.id = :rdv_id";

    try {
        // Prépare et exécute la requête
        $stmt = $objetPdo->prepare($sql);
        $stmt->bindParam(':rdv_id', $rdv_id, PDO::PARAM_INT);
        $stmt->execute();

        // Récupère les résultats
        $rdv = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifie si un rendez-vous a été trouvé
        if (!$rdv) {
            echo "Aucun rendez-vous trouvé pour l'ID : " . htmlspecialchars($rdv_id);
            exit;
        }
        
        
        $rdv['dateHour'] = date('d-m-Y H:i', strtotime($rdv['dateHour']));
    } catch (PDOException $error) {
        echo "Erreur lors de la récupération du rendez-vous : " . $error->getMessage();
        exit;
    }
} else {
    echo "ID du rendez-vous invalide : " . htmlspecialchars($_GET['id'] ?? 'non spécifié');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Rendez-vous</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <h2>Détails du Rendez-vous</h2>

    <!-- Affichage des détails du rendez-vous -->
    <div class="rdv-details">
        <p><strong>Nom :</strong> <?= htmlspecialchars($rdv['lastname']) ?></p>
        <p><strong>Prénom :</strong> <?= htmlspecialchars($rdv['firstname']) ?></p>
        <p><strong>Date et Heure :</strong> <?= htmlspecialchars($rdv['dateHour']) ?></p>
        <p><strong>ID du Patient :</strong> <?= htmlspecialchars($rdv['patient_id']) ?></p>
        <p><strong>Date de naissance :</strong> <?= htmlspecialchars($rdv['birthdate']) ?></p>
        <p><strong>Téléphone :</strong> <?= htmlspecialchars($rdv['phone']) ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($rdv['mail']) ?></p>

        <a href="liste-rdv.php">Retour à la liste des rendez-vous</a>
        <a href="modifier-rdv.php?id=<?= $rdv['rdv_id'] ?>">Modifier rdv</a>
      
        

    </div>

</body>
</html>
