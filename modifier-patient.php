<?php

require_once './utils/connect_db.php';  // on connecte le fichier avec la BDD



$stmt = $objetPdo->query('SELECT * FROM patients WHERE id=' . $_GET['id']);
$users = $stmt->fetch();

?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les informations du patient</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <h2>Modifier les informations du patient</h2>

  
    <form action="./process-modifier.php" method="post">
        <label for="lastname"> Nom :</label>
        <input type="text" name="lastname" id="lastname" value="<?= $users['lastname'] ?>">

        <label for="firstname"> Prénom :</label>
        <input type="text" name="firstname" id="firstname" value="<?= $users['firstname'] ?>">

        <label for="birthdate"> Date de naissance :</label>
        <input type="date" name="birthdate" id="birthdate" value="<?= $users['birthdate'] ?>">

        <label for="phone"> Téléphone :</label>
        <input type="tel" name="phone" id="phone" value="<?= htmlspecialchars(preg_replace('/\s+/', '', $users['phone']))?>">

        <label for="mail"> E-mail :</label>
        <input type="email" name="mail" id="mail" value ="<?= $users['mail'] ?> ">

        <input type="hidden" name="idPatient" value="<?= $users["id"] ?>">

        <input type="submit" value="Modifier les informations du patient ">
    </form>



</body>

</html>