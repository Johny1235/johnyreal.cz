<?php

$imageFolder = "weapon-images";

function createWeapon($db, $name, $material, $descript, $picture) {
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
    INSERT INTO cold_weapons (name, material, descript, picture)
    VALUES
    (?, ?, ?, ?)
    ");

    if ($statement === false) {
        echo "<p>Nastala chyba s vytvořením chladné zbraně!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
    }

    mysqli_stmt_bind_param($statement, "ssss", $name, $material, $descript, $imagePath);

    $result = mysqli_execute($statement);

    if ($result === false) {
        echo "<p>Nastala chyba s vytvořením chladné zbraně!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
        exit;
    }
}

function listWeapons($db) {
    $result = mysqli_query($db, "
        SELECT *
        FROM cold_weapons
        ORDER BY id ASC;
    ");
    if ($result === false) {
        echo "<p>Nastala chyba se zobrazením chladných zbraní!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
        return [];
    } else {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

function deleteWeapons($db, $id) {
    $statement = mysqli_prepare($db, "
    DELETE FROM cold_weapons 
    WHERE id = ?
    ");

    if ($statement === false) {
        echo "<p>Nastala chyba s odstraněním chladné zbraně!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
    }

    mysqli_stmt_bind_param($statement, "i", $id);

    $result = mysqli_execute($statement);

    if ($result === false) {
        echo "<p>Nastala chyba s odstraněním chladné zbraně!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
        exit;
    }
}

function getWeapons($db, $id) {
    $statement = mysqli_prepare($db, "
    SELECT * FROM cold_weapons 
    WHERE id = ?
    ");

    if ($statement === false) {
        echo "<p>Nastala chyba se zobrazením chladných zbraní!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
        return null;
    }

    mysqli_stmt_bind_param($statement, "i", $id);

    if (mysqli_execute($statement)) {
        $result = mysqli_stmt_get_result($statement);
        return mysqli_fetch_assoc($result);
    } else {
        echo "<p>Nastala chyba se zobrazením chladných zbraní!</p>";
        return null;
    }
}


function editWeapon($db, $name, $material, $descript, $id, $picture) {
    global $imageFolder;
    
    $statement = mysqli_prepare($db, "
    UPDATE cold_weapons SET name = ?, material = ?, descript = ?, picture = ?
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

    mysqli_stmt_bind_param($statement, "ssssi", $name, $material, $descript, $imagePath, $id);

    $result = mysqli_execute($statement);

    if ($result === false) {
        echo "<p>Nastala chyba s editem zbraně!</p>";
        echo "<p>" . mysqli_error($db) . "</p>";
        exit;
    }
}
