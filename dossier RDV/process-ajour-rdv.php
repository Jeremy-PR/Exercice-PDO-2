<?php
require_once '../utils/connect_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $idPatient = $_POST['id_patient'];  // L'ID du patient sélectionné
    $dateHour = $_POST['dateHour'];     // Date et heure du rendez-vous

    // Insérer un nouveau rendez-vous dans la base de données
    $sql = "INSERT INTO appointments (dateHour, idPatients) VALUES (:dateHour, :idPatient)";

    try {
        $stmt = $objetPdo->prepare($sql);
        $stmt->execute([
            'dateHour' => $dateHour,  // Date et heure du rendez-vous
            'idPatient' => $idPatient // ID du patient
        ]);

        // Rediriger vers une page de confirmation ou accueil
        header('Location: liste-rdv.php');
        exit();
    } catch (PDOException $error) {
        echo "Erreur lors de l'enregistrement du rendez-vous : " . $error->getMessage();
    }
}
?>
