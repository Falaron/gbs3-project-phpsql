<?php 
  require('config.php');

  // Define dataBinded array before using it
  $dataBinded = array(
    ':delPlayer' => $_POST['delPlayer']
  );

  $sqlDeleteGames = "DELETE FROM GAMES WHERE ID_PLAYER = :delPlayer";
  $preDeleteGames = $pdo->prepare($sqlDeleteGames);
  $preDeleteGames->execute($dataBinded);

  $sqlDeleteSkills = "DELETE FROM SKILLS WHERE ID_PLAYER = :delPlayer";
  $preDeleteSkills = $pdo->prepare($sqlDeleteSkills);
  $preDeleteSkills->execute($dataBinded);

  $sql = "DELETE FROM PLAYER WHERE ID = :delPlayer";
  $pre = $pdo->prepare($sql);
  $pre->execute($dataBinded);

  header('Location:../admin.php');
  exit();
?>
