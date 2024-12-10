<?php

require_once './utils/connect_db.php';


$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$date = $_POST['birthdate'];
$phone = $_POST['phone'];
$mail = $_POST['mail'];
$idPatient = $_POST['idPatient']; 


if (empty($lastname) || empty($firstname) || empty($date) || empty($phone) || empty($mail) || empty($idPatient)) {
    die("Tous les champs doivent être remplis.");
}


$sql = "UPDATE patients
        SET
            lastname = :lastname,
            firstname = :firstname,
            birthdate = :birthdate,
            phone = :phone,
            mail = :mail
        WHERE
            id = :id";

try {
    
    $stmt = $objetPdo->prepare($sql);
   
    $stmt->execute([
        ':lastname' => $lastname,
        ':firstname' => $firstname,
        ':birthdate' => $date,
        ':phone' => $phone,
        ':mail' => $mail,
        ':id' => $idPatient,
    ]);

    
    $affectedRows = $stmt->rowCount();
    if ($affectedRows > 0) {
        echo "Les informations du patient ont été mises à jour avec succès.";
    } else {
        echo "Aucune mise à jour effectuée. Vérifiez si les données sont déjà à jour.";
    }
} catch (PDOException $error) {
    error_log("Erreur lors de la requête: " . $error->getMessage());
    echo "Erreur lors de la mise à jour des informations.";
}


header("Location: ./liste-patient.php");
exit;

?>
