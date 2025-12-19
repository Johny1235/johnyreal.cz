<?php

require "./db/connect.php";
require "./db/users.php";

if(isset($_POST["loginForm"]))
{
    loginUser($db, $_POST["username"], $_POST["password"]);
}

require "./layout/head.phtml";
require "./pages/login.phtml";
require "./layout/tail.phtml";