
<?php

require_once '../utils/connect_db.php';




$sql = "INSERT INTO appointments (id, dateHour, idPatients)
 VALUES (:id, :dateHour, :idPatients)";

try {
    $stmt = $objetPdo->prepare($sql);
    $users = $stmt->execute([
        ':id' => $_POST["idPatients"],
        ':dateHour' => $_POST["dateHour"],
        ':idPatients' => $_POST["idPatients"]

    ]);
} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}


header("Location: ./liste-rdv.php");


?>