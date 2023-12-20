<?php 
  require('config.php');

  $sql = "DELETE FROM GAMES WHERE ID = :delGameRank";

  $dataBinded=array(
    ':delGameRank' => $_POST['delGameRank']
  );

  $pre = $pdo->prepare($sql);
  $pre->execute($dataBinded);

  header('Location:../admin.php');
?>