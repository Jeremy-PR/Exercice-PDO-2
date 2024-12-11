<?php
require_once '../utils/connect_db.php';  // Connexion à la base de données

// Vérifier si les données du formulaire sont soumises
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_patient = $_POST['id_patient'];
    $dateHour = $_POST['dateHour'];
    $rdv_id = $_POST['rdv_id'];  // Récupérer l'ID du rendez-vous depuis le champ caché

    // Vérifier si les données sont valides
    if (empty($id_patient) || empty($dateHour)) {
        echo "Tous les champs doivent être remplis.";
        exit;
    }

    // Échapper les variables pour prévenir les injections SQL
    $id_patient = $objetPdo->quote($id_patient);
    $dateHour = $objetPdo->quote($dateHour);
    $rdv_id = $objetPdo->quote($rdv_id);

    // Requête SQL pour mettre à jour le rendez-vous (sans bindParam)
    $sql = "UPDATE appointments SET idPatients = $id_patient, dateHour = $dateHour WHERE id = $rdv_id";

    try {
        // Exécuter la requête
        $objetPdo->exec($sql);
        echo "Rendez-vous mis à jour avec succès.";
        header('Location: liste-rdv.php');  // Redirection après succès
        exit;  // Terminer l'exécution du script
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
