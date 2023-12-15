<?php 
  require('config.php');

  $sql = "DELETE FROM MANAGER WHERE ID = :delManager";

  $dataBinded=array(
    ':delManager' => $_POST['delManager']
  );

  $pre = $pdo->prepare($sql);
  $pre->execute($dataBinded);

  header('Location:../admin.php');
?>