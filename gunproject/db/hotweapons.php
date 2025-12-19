<?php

$imageFolder = "gun-images";

function createGun($db, $name, $caliber, $descript, $rang, $picture) {
    global $imageFolder;
    
    $imagePath = "";

    if (strpos($picture["type"], "image/") !== 0) {
        echo "<p>Lze nahrát jen obrázky!</p>";
        return;
    }

    if (!file_exists($imageFolder)) {
         mkdir($imageFolder);
    }

    $imagePath = $imageFolder . "/" . uniqid() . $picture["name"];
    move_uploaded_file($picture["tmp_name"], $imagePath);

    $statement = mysqli_prepare($db, "
    INSERT INTO modern_weapons (name, caliber, descript, rang, picture)
    VALUES
    (?, ?, ?, ?, ?)
    ");

    if ($statement === false) {
        echo "<p>Nastala chyba s vytvořením střelné zbraně!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
    }

    mysqli_stmt_bind_param($statement, "sssis", $name, $caliber, $descript, $rang, $imagePath);

    $result = mysqli_execute($statement);

    if ($result === false) {
        echo "<p>Nastala chyba s vytvořením střelné zbraně!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
        exit;
    }
}

function listGuns($db) {
    $result = mysqli_query($db, "
        SELECT *
        FROM modern_weapons
        ORDER BY id ASC;
    ");
    if ($result === false) {
        echo "<p>Nastala chyba se zobrazením střelných zbraní!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
        return [];
    } else {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

function deleteGuns($db, $id) {
    $statement = mysqli_prepare($db, "
    DELETE FROM modern_weapons 
    WHERE id = ?
    ");

    if ($statement === false) {
        echo "<p>Nastala chyba s odstraněním střelné zbraně!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
    }

    mysqli_stmt_bind_param($statement, "i", $id);

    $result = mysqli_execute($statement);

    if ($result === false) {
        echo "<p>Nastala chyba s odstraněním střelné zbraně!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
        exit;
    }
}

function getGuns($db, $id) {
    $statement = mysqli_prepare($db, "
    SELECT * FROM modern_weapons 
    WHERE id = ?
    ");

    if ($statement === false) {
        echo "<p>Nastala chyba se zobrazením střelných zbraní!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
        return null;
    }

    mysqli_stmt_bind_param($statement, "i", $id);

    if (mysqli_execute($statement)) {
        $result = mysqli_stmt_get_result($statement);
        return mysqli_fetch_assoc($result);
    } else {
        echo "<p>Nastala chyba se zobrazením střelných zbraní!</p>";
        return null;
    }
}


function editGun($db, $name, $caliber, $descript, $rang, $id, $picture) {
    global $imageFolder;
    
    $statement = mysqli_prepare($db, "
    UPDATE modern_weapons SET name = ?, caliber = ?, descript = ?, rang = ?, picture = ?
    WHERE id = ?;
    ");
    
    $imagePath = null;

    if($picture["error"] !== UPLOAD_ERR_NO_FILE)
    {
        if ($picture["error"] !== UPLOAD_ERR_OK) {
            echo "<p>Chyba nahrávání obrázku!</p>";
            return;
        }

        if (strpos($picture["type"], "image/") !== 0) {
            echo "<p>Lze nahrát jen obrázky!</p>";
            return;
        }

        $imagePath = $imageFolder . "/" . uniqid() . $picture["name"];
        move_uploaded_file($picture["tmp_name"], $imagePath);        
        
    }

    if ($statement === false) {
        echo "<p>Nastala chyba s editem zbraně!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
    }

    mysqli_stmt_bind_param($statement, "sssisi", $name, $caliber, $descript, $rang, $imagePath, $id);

    $result = mysqli_execute($statement);

    if ($result === false) {
        echo "<p>Nastala chyba s editem zbraně!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
        exit;
    }
}
