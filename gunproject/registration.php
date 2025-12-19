<?php

require "./db/connect.php";
require "./db/users.php";
require "./layout/head.phtml";
require "./pages/registration.phtml";

if(isset($_POST["registerForm"]))
{
    if($_POST["password"] !== $_POST["passwordConfirm"])
    {
        echo "<br><b><i><p>Hesla se neshodují!</b></i><p>";
    }
    else
    {
        registerUser($db, $_POST["username"], $_POST["email"], $_POST["password"]);
    }
}

require "./layout/tail.phtml";