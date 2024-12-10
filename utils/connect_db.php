<?php
try {
    // Informations de connexion
    $host = "localhost";
    $dbname = "hospitale2n";
    $login = "root";
    $password = "";

    // Création de la connexion PDO et stockage dans la variable $objetPdo
    $objetPdo = new PDO("mysql:host={$host};dbname={$dbname}", $login, $password);

    // Définir le mode d'erreur pour afficher les erreurs PDO
    $objetPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $error) {
    // En cas d'échec de la connexion, afficher l'erreur
    echo "Erreur de connexion : " . $error->getMessage();
}
?>
