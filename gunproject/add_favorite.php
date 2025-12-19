<?php
require "./db/connect.php";

if (!isset($_SESSION["loggedUser"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["loggedUser"]["id"];
$weapon_name = $_POST["weapon_name"] ?? "";
$weapon_type = $_POST["weapon_type"] ?? "";

if ($weapon_name && in_array($weapon_type, ['hot', 'cold'])) {
    $statement = mysqli_prepare($db, "
        INSERT INTO favorite_weapons (user_id, weapon_name, weapon_type) 
        VALUES (?, ?, ?)
    ");

    mysqli_stmt_bind_param($statement, "iss", $user_id, $weapon_name, $weapon_type);
    mysqli_stmt_execute($statement);
}

header("Location: favorites.php");
exit;
