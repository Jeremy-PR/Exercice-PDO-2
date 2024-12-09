<?php



?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'ajout d'un patient</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Formulaire d'ajout d'un patient</h1>
    <form action="./process.php" method="POST">
        <!-- Nom -->
        <label for="lastname">Nom :</label>
        <input type="text" id="lastname" name="lastname" required><br><br>
        
        <!-- Prénom -->
        <label for="firstname">Prénom :</label>
        <input type="text" id="prefirstnamenom" name="firstname" required><br><br>
        
        <!-- Date de naissance -->
        <label for="birthdate">Date de naissance :</label>
        <input type="date" id="birthdate" name="birthdate" required><br><br>
        
        
        
        <!-- Téléphone -->
        <label for="phone">Téléphone :</label>
        <input type="tel" id="phone" name="phone" required><br><br>
        
        <!-- Email -->
        <label for="mail">Email :</label>
        <input type="email" id="mail" name="mail" required><br><br>
        
   
        <!-- Bouton d'envoi -->
        <button type="submit">Ajouter le patient</button>
    </form>
</body>
</html>