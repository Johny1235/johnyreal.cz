<?php

require "./db/connect.php";
require "./db/hotweapons.php";

if(isset($_POST["sendButtonHotWeapon"])) {
    createGun($db, $_POST["name"], $_POST["caliber"], $_POST["descript"], $_POST["rang"], $_FILES["picture"]);
}

require "./layout/head.phtml";
require "./pages/addhotweapon.phtml";
require "./layout/tail.phtml";