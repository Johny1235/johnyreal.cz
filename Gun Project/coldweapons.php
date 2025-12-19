<?php

require "./db/connect.php";
require "./db/coldweapons.php";

if(isset($_POST["deleteWeapon"])) {
    deleteWeapons($db, $_POST["id"]);
}

require "./layout/head.phtml";

if(isset($_GET["edit"]))
{
    if(isset($_POST["editButtonWeapon"]))
    {
        editWeapon($db, $_POST["name"], $_POST["material"], $_POST["descript"], $_GET["edit"], $_FILES["picture"]);
    }
    $weapon = getWeapons($db, $_GET["edit"]);
    require "./pages/editcoldweapon.phtml";
}
else
{
    $weapons = listWeapons($db);
    require "./pages/coldweapons.phtml";
}

require "./layout/tail.phtml";