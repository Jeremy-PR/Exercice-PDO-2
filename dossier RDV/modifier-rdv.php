<?php
require_once '../utils/connect_db.php';  

// Vérifier si l'ID est passé dans l'URL et s'il est valide
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $rdv_id = $_GET['id'];

    // Récupérer les détails du rendez-vous
    $stmt = $objetPdo->query('SELECT * FROM appointments WHERE id = ' . $rdv_id);
    $rdv = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$rdv) {
        echo "Rendez-vous introuvable.";
        exit;
    }

    // Je récupère les patients pour le menu déroulant
    $stmtPatients = $objetPdo->query('SELECT id, firstname, lastname FROM patients');
    $patients = $stmtPatients->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "ID du rendez-vous invalide.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Rendez-vous</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <h2>Modifier le Rendez-vous</h2>

    <form method="post" action="./process-modif-rdv.php">
    <input type="hidden" name="rdv_id" value="<?= htmlspecialchars($_GET['id']) ?>">
        <div class="rowTab3"> 
            <div class="labels3">
                <label for="patient">Choisir un patient :</label>
            </div>
            <div class="rightTab3">
                <select name="id_patient" id="patient" class="input-field" required>
                    <option value="">Sélectionner un patient</option>
                    <?php
                    foreach ($patients as $patient) {
                        $selected = ($rdv['idPatients'] == $patient['id']) ? 'selected' : '';
                        echo '<option value="' . $patient['id'] . '" ' . $selected . '>' . htmlspecialchars($patient['firstname']) . ' ' . htmlspecialchars($patient['lastname']) . '</option>';
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
                <input type="datetime-local" name="dateHour" class="input-field" value="<?= htmlspecialchars($rdv['dateHour']) ?>" required>
            </div>     
        </div>

        <button class="action-button animate red">Soumettre</button>
    
    </form>

</body>
</html>
