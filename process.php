<?php
require_once './connect_db.php';

// VALIDATION DU FORMULAIRE

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../ajout_patient.php');
    exit;
}

if (
    !isset(
        $_POST['lastname'],
        $_POST['firstname'],
        $_POST['birthdate'],
        $_POST['phone'],
        $_POST['mail']
    )
) {
    header('Location: ../ajout_patient.php');
    exit;
}

if (
    empty($_POST['lastname']) ||
    empty($_POST['firstname']) ||
    empty($_POST['birthdate']) ||
    empty($_POST['phone']) ||
    empty($_POST['mail'])
) {
    header('Location: ../ajout_patient.php');
    exit;
}

// Input sanitization
$lastname = htmlspecialchars(trim($_POST['lastname']));
$firstname = htmlspecialchars(trim($_POST['firstname']));
$birthdate = htmlspecialchars(trim($_POST['birthdate']));
$phone = htmlspecialchars(trim($_POST['phone']));
$email = htmlspecialchars(trim($_POST['mail']));

// Check maximum lengths
if (
    strlen($lastname) > 50 ||
    strlen($firstname) > 50 ||
    strlen($birthdate) > 50 ||
    strlen($phone) > 50 ||
    strlen($email) > 50
) {
    header('Location: ../ajout_patient.php');
    exit;
}

// SQL INSERT statement
$sql = "INSERT INTO patients (lastname, firstname, birthdate, phone, mail)
        VALUES (:lastname, :firstname, :birthdate, :phone, :email)";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':lastname' => $lastname,
        ':firstname' => $firstname,
        ':birthdate' => $birthdate,
        ':phone' => $phone,
        ':email' => $email
    ]);
} catch (PDOException $error) {
    echo "Erreur lors de la requête : " . $error->getMessage();
    exit;
}

// Redirect to the patient list
header("Location: ../liste_patients.php");
exit;
?>
