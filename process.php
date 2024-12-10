
<?php

require_once './utils/connect_db.php';








$sql = "INSERT INTO patients (lastname, firstname, birthdate, phone , mail)
 VALUES (:lastname, :firstname, :birthdate , :phone, :mail  )";

try {
    $stmt = $objetPdo->prepare($sql);
    $users = $stmt->execute([
        ':lastname' => $_POST["lastname"],
        ':firstname' => $_POST["firstname"],
        ':birthdate' => $_POST["birthdate"],
        ':phone' => $_POST["birthdate"],
        ':mail' => $_POST["mail"]
    ]); 




} catch (PDOException $error) {
    echo "Erreur lors de la requete : " . $error->getMessage();
}


header("Location: ./liste-patient.php");


?>