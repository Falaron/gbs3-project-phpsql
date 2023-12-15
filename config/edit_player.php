<?php
  require ('image_detection.php');
  require('config.php');

  $sql = "SELECT * FROM PLAYER";
  $pre = $pdo->prepare($sql); 
  $pre->execute();
  $data = $pre->fetch(PDO::FETCH_ASSOC);

  var_dump($_POST);

  foreach($_POST as $key => $value){
    if(!empty($value)){
        if (isImage($value) == true){ // Checking if the value is an image
        $name = $_FILES[$key]['name'];
        $actual_name = pathinfo($name ,PATHINFO_FILENAME);
        $original_name = $actual_name;
        $extension = pathinfo($name , PATHINFO_EXTENSION);

        $destination = "../assets/img/".$name;
        if (file_exists("../assets/img/".$actual_name.".".$extension)) {
            $i = 1;
            do {
                $actual_name = (string)$original_name.$i;
                $name = $actual_name.".".$extension;
                $i++;
                $destination = "../assets/img/".$actual_name.".".$extension;
            } while(file_exists($destination));
        }
        move_uploaded_file($_FILES[$key]['tmp_name'],$destination);
        $value = "/gbs3-project-phpsql/assets/img/".$name;
    }
        $sql = "UPDATE PLAYER SET $key = :value WHERE ID = :id";
        $dataBinded = array(
            ':value'=> $value,
            ':id'=> $_GET['id']
        );
        $pre = $pdo->prepare($sql);
        $pre->execute($dataBinded);
    };
  };
  
  //header('Location:../admin.php');
?>