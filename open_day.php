<?php
// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'calendar_db');
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Erreur de connexion à la base de données.']));
}

// Récupération du jour cliqué
$day = intval($_POST['day']);
$currentDay = date('j');

// Validation : le jour doit être égal ou inférieur à la date actuelle
if ($day > $currentDay) {
    echo json_encode(['success' => false, 'error' => 'Vous ne pouvez pas ouvrir ce jour avant la date prévue.']);
    exit;
}

// Récupération du message
$result = $conn->query("SELECT * FROM calendar_days WHERE day = $day");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $message = $row['message'];

    // Marquer le jour comme ouvert
    $conn->query("UPDATE calendar_days SET is_opened = 1 WHERE day = $day");

    echo json_encode(['success' => true, 'message' => $message]);
} else {
    echo json_encode(['success' => false, 'error' => 'Jour non trouvé.']);
}

// Fermeture de la connexion
$conn->close();
?>
