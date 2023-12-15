<?php 
    require('config.php');
    $sql = "SELECT * FROM MANAGER"; 
    $pre = $pdo->prepare($sql); 
    $pre->execute();
    $dataUpdate = $pre->fetch(PDO::FETCH_ASSOC);

    foreach($_POST as $key => $value){
        $sql = "UPDATE MANAGER SET $key = :value WHERE ID = :id";
        $dataBinded = array(
            ':value'=> $value,
            ':id'=> $_GET['id']
        );
        $pre = $pdo->prepare($sql);
        $pre->execute($dataBinded);
    };

    header('Location:../admin.php');
?>