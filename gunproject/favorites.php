<?php
require "./db/connect.php";
require "./layout/head.phtml";

if (!isset($_SESSION["loggedUser"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["loggedUser"]["id"];

$sql = "
    SELECT f.weapon_name, f.weapon_type, 
           hw.id AS hot_id, cw.id AS cold_id
    FROM favorite_weapons f
    LEFT JOIN modern_weapons hw ON f.weapon_type = 'hot' AND f.weapon_name = hw.name
    LEFT JOIN cold_weapons cw ON f.weapon_type = 'cold' AND f.weapon_name = cw.name
    WHERE f.user_id = ?
    AND (hw.id IS NOT NULL OR cw.id IS NOT NULL)
";


$statement = mysqli_prepare($db, $sql);

mysqli_stmt_bind_param($statement, "i", $user_id);

mysqli_stmt_execute($statement);

$result = mysqli_stmt_get_result($statement);

$favorites = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<h1>Oblíbené zbraně</h1>
<?php if (count($favorites) === 0): ?>
    <p>Nemáš zatím žádné oblíbené zbraně.</p>
<?php else: ?>
    <ul class="ulko">
        <?php foreach ($favorites as $fav): ?>
            <?php
                $link = "";
                if ($fav["weapon_type"] === "hot" && $fav["hot_id"]) {
                    $link = "hotweapon_detail.php?id=" . $fav["hot_id"];
                } elseif ($fav["weapon_type"] === "cold" && $fav["cold_id"]) {
                    $link = "coldweapon_detail.php?id=" . $fav["cold_id"];
                }
            ?>
            <li>
                <a href="<?= htmlspecialchars($link) ?>">
                    <?= htmlspecialchars($fav["weapon_name"]) ?> (<?= $fav["weapon_type"] === 'hot' ? 'střelná' : 'chladná' ?>)
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<br>
<button class="button"><a href="index.php">Zpět domů</a></button>

<?php require "./layout/tail.phtml"; ?>
