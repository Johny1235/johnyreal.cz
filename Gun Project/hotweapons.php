<?php

require "./db/connect.php";
require "./db/hotweapons.php";

if(isset($_POST["deleteGun"])) {
    deleteGuns($db, $_POST["id"]);
}

require "./layout/head.phtml";

if(isset($_GET["edit"]))
{
    if(isset($_POST["editButtonGun"]))
    {
        editGun($db, $_POST["name"], $_POST["caliber"], $_POST["descript"], $_POST["rang"], $_GET["edit"], $_FILES["picture"]);
    }
    $gun = getGuns($db, $_GET["edit"]);
    require "./pages/edithotweapon.phtml";
}
else
{
    $guns = listGuns($db);
    require "./pages/hotweapons.phtml";
}

require "./layout/tail.phtml";