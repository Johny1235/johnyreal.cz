<?php
require "./db/connect.php";
require "./layout/head.phtml"; 

$id = $_GET['id'] ?? '';
$statement = mysqli_prepare($db, "
    SELECT * FROM modern_weapons 
    WHERE id = ?
    ");

if ($statement === false) {
        echo "<p>Nastala chyba!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
        return null;
    }

mysqli_stmt_bind_param($statement, "i", $id);

if (mysqli_execute($statement)) {
    $result = mysqli_stmt_get_result($statement);
    $gun = mysqli_fetch_assoc($result);
    if (!$gun) {
        echo "<p>Zbraň nebyla nalezena.</p>";
        return;
    }
} else {
    echo "<p>Nastala chyba!</p>";
    return;
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Detail střelné zbraně</title>
</head>
<body>
    <h1>Detail střelné zbraně</h1>
    <h2><strong> <?= htmlspecialchars($gun['name']) ?></strong></h2><br>
    <p><strong>Ráže:</strong> <?= htmlspecialchars($gun['caliber']) ?></p><br>
    <p><strong>Úsťová rychlost:</strong> <?= htmlspecialchars($gun['rang']) ?> m/s</p><br>
    <p><strong>Popis:</strong><br> <?= nl2br(htmlspecialchars($gun['descript'])) ?></p><br>
    <?php if (!empty($gun['picture'])): ?>
        <br>
        <p><img src="<?= htmlspecialchars($gun['picture']) ?>" alt="Obrázek zbraně" ax-height="200px" height="180px"></p>
    <?php endif; ?>
    <br>
    <p><a href="hotweapons.php" class="button">Zpět na seznam</a></p>
</body>
</html>

<?php
require "./layout/tail.phtml";
?>