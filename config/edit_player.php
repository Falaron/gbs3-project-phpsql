<?php
    require('config.php');

    $sql = "SELECT * FROM PLAYER";
    $pre = $pdo->prepare($sql); 
    $pre->execute();
    $data = $pre->fetch(PDO::FETCH_ASSOC);
    
    // Pour chaque POST (pas file)
    foreach($_POST as $key => $value) {
        if(!empty($value)) {
            $sql = "UPDATE PLAYER SET $key = :value WHERE ID = :id";
            $dataBinded = array(
                ':value'=> $value,
                ':id'=> $_GET['id']
            );
            $pre = $pdo->prepare($sql);
            $pre->execute($dataBinded);  
        }
    }
    
    // Pour chaque file
    foreach($_FILES as $fileKey => $fileInfo) {
        if (!empty($fileInfo['name']) && is_uploaded_file($fileInfo['tmp_name'])) {
            $tmpName = $fileInfo['tmp_name'];
            $name = $fileInfo['name'];
    
            $uniqueName = uniqid('', true);
            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));
    
            $file = $uniqueName.".".$extension;
            move_uploaded_file($tmpName, '../assets/img/'.$file);
            $value = "/gbs3-project-phpsql/assets/img/".$file;
    
            $sql = "UPDATE PLAYER SET $fileKey = :value WHERE ID = :id";
            $dataBinded = array(
                ':value' => $value,
                ':id' => $_GET['id']
            );
            $pre = $pdo->prepare($sql);
            $pre->execute($dataBinded);  
        }
    }
  
    header('Location:../admin.php');
?>