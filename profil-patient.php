<?php



require_once './connect_db.php';  // on connecte le fichier avec la BDD

$id = $_GET['id'] ?? null;  // Ici, l'opérateur ?? est utilisé pour vérifier si la variable 'id' existe dans l'URL. Si elle existe, sa valeur est assignée à $id, sinon $id prend la valeur null.

if ($id && is_numeric($id)) {   // Vérification si $id existe (c'est-à-dire s'il n'est pas null) et si $id est un nombre (is_numeric vérifie que la valeur est un nombre ou une chaîne contenant un nombre).

    // Si les conditions sont remplies, on prépare la requête SQL pour récupérer les informations du patient avec l'ID spécifié.
    $sql = "SELECT * FROM patients WHERE id = :id";

    try {
        // Tentative de préparation et d'exécution de la requête SQL avec PDO.
        $stmt = $objetPdo->prepare($sql);  // Préparation de la requête SQL avec un paramètre lié ":id"
        
        // Exécution de la requête en passant l'ID récupéré comme paramètre. ":id" est remplacé par la valeur de $id.
        $stmt->execute(['id' => $id]);

        // Récupération des données du patient sous forme de tableau associatif.
        $user = $stmt->fetch(PDO::FETCH_ASSOC);  // Cela renvoie la première ligne de la table 'patients' où l'ID correspond à celui passé.

    } catch (PDOException $error) {
        // Si une erreur se produit lors de la requête, l'exception est capturée et un message d'erreur est affiché.
        echo "Erreur lors de la requête : " . $error->getMessage();
    }
} else {
    // Si $id est invalide (non spécifié ou non numérique), ce message est affiché.
    echo "ID invalide ou non spécifié.";
}










?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil patient</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php if (isset($user)): ?>
        
        <p><strong>Nom : </strong><?php echo htmlspecialchars($user['lastname']); ?></p>
        <p><strong>Prénom : </strong><?php echo htmlspecialchars($user['firstname']); ?></p>
        <p><strong>Date de naissance : </strong><?php echo htmlspecialchars($user['birthdate']); ?></p>
        <p><strong>Email : </strong><?php echo htmlspecialchars($user['mail']); ?></p>
        <p><strong>Numéro de téléphone: </strong><?php echo htmlspecialchars($user['phone']); ?></p>
        <a href="./modifier-patient.php?id=<?= $user['id'] ?>">Modifier les informations du patient</a>

  
    <?php else: ?>
        <p>Le profil du patient n'a pas pu être trouvé.</p>
    <?php endif; ?>
</body>
</html>
