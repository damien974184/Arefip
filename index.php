<?php
// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'calendar_db');
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Récupération des jours depuis la base
$result = $conn->query("SELECT * FROM calendar_days");
$days = [];
while ($row = $result->fetch_assoc()) {
    $days[] = $row;
}

// Fermeture de la connexion
$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier de l'Avent</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="calendar-container">
        <h1>Calendrier de l'Avent - Centre de Formation</h1>
        <div class="calendar">
            <?php foreach ($days as $day): ?>
                <div class="day <?php echo $day['is_opened'] ? 'opened' : ''; ?>" data-day="<?php echo $day['day']; ?>">
                    <?php echo $day['day']; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
