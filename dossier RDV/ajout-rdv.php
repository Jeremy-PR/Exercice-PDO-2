<?php
require_once '../utils/connect_db.php';


$sql = "SELECT * FROM patients";
try {
    $stmt = $objetPdo->query($sql);
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo "Erreur lors de la récupération des patients : " . $error->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre un RDV</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <h2>Prendre un rendez-vous</h2>

    <form method="post" action="./process-ajour-rdv.php">
      
        <div class="rowTab3"> 
            <div class="labels3">
                <label for="patient">Choisir un patient :</label>
            </div>
            <div class="rightTab3">
                <select name="id_patient" id="patient" class="input-field" required>
                    <option value="">Sélectionner un patient</option>
                    <?php
                    // Remplir le menu déroulant avec les patients
                    foreach ($patients as $patient) {
                        echo '<option value="' . $patient['id'] . '">' . htmlspecialchars($patient['firstname']) . ' ' . htmlspecialchars($patient['lastname']) . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

      
        <div class="rowTab3"> 
            <div class="labels3">
                <label>Choisir une date et une heure :</label>
            </div>
            <div class="rightTab3">
                <input type="datetime-local" name="dateHour" class="input-field" required>
            </div>     
        </div>

        <button class="action-button animate red">Soumettre</button>
        <a href="../index.php">Retour à l'accueil</a>
        <a href="./liste-rdv.php">Liste des rdv actuels</a>
    </form>

</body>
</html>
