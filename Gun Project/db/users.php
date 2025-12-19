<?php

function registerUser($db, $username, $email, $password)
{
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $statement = mysqli_prepare($db, "
    INSERT INTO users (username, email, password)
    VALUES
    (?, ?, ?)
    ");

    if ($statement === false) {
        echo "<p>Nastala chyba s vytvořením uživatele!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
        exit;
    }

    mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashedPassword);

    $result = mysqli_execute($statement);

    if ($result === false) {
        echo "<p>Nastala chyba s vytvořením uživatele!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
        exit;
    }
}

function getUser($db, $username) {
    $statement = mysqli_prepare($db, "
    SELECT * FROM users 
    WHERE username = ?
    ");

    if ($statement === false) {
        echo "<p>Nastala chyba se získáním uživatele!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
    }

    mysqli_stmt_bind_param($statement, "s", $username);

    $result = mysqli_execute($statement);

    if ($result === false) {
        echo "<p>Nastala chyba se získáním uživatele!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
        exit;
    }

    return mysqli_fetch_assoc(mysqli_stmt_get_result($statement));
}

function loginUser($db, $username, $password)
{
    $user = getUser($db, $username);

    if($user === null || !password_verify($password, $user["password"]))
    {
        echo "<br><h3><i>Neplatné přihlašovací údaje!</i></h3>";
        return;
    }

    //echo "<p>Úspěšně přihlášen(a)</p>";

    $_SESSION["loggedUser"] = $user;
}