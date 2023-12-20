<?php
    require('config.php');
    
    $fileInfo = $_FILES["profile_picture"];
    $tmpName = $fileInfo['tmp_name'];
    $name = $fileInfo['name'];
var_dump($tmpName);

    $uniqueName = uniqid('', true);
    $tabExtension = explode('.', $name);
    $extension = strtolower(end($tabExtension));

    $file = $uniqueName.".".$extension;
    move_uploaded_file($tmpName, '../assets/img/'.$file);
    $imgValue = "/gbs3-project-phpsql/assets/img/".$file;

    $sqlInsert = "INSERT INTO PLAYER(player_name, player_bio, twitter, linked_In, profilepicture) VALUES (:player_name, :player_bio, :twitter, :linked_In, :profilepicture)";

    $dataBindedInsert = array(
        ':player_name' => $_POST['player_name'],
        ':player_bio' => $_POST['player_bio'],
        ':twitter' => $_POST['twitter'],
        ':linked_In' => $_POST['linked_In'],
        ':profilepicture' => $imgValue
    );
    var_dump($dataBindedInsert);

    $preInsert = $pdo->prepare($sqlInsert);
    $preInsert->execute($dataBindedInsert);
?>