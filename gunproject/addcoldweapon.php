<?php

require "./db/connect.php";
require "./db/coldweapons.php";

if(isset($_POST["sendButtonColdWeapon"])) {
    createWeapon($db, $_POST["name"], $_POST["material"], $_POST["descript"], $_FILES["picture"]);
}

require "./layout/head.phtml";
require "./pages/addcoldweapon.phtml";
require "./layout/tail.phtml";