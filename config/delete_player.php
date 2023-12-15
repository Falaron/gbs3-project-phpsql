<?php 
  require('config.php');

  $sql = "DELETE FROM PLAYER WHERE ID = :delPlayer";

  $dataBinded=array(
    ':delPlayer' => $_POST['delPlayer']
  );

  $pre = $pdo->prepare($sql);
  $pre->execute($dataBinded);

  header('Location:../admin.php');
?>