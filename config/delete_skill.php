<?php 
  require('config.php');

  $sql = "DELETE FROM SKILLS WHERE ID = :delSkill";

  $dataBinded=array(
    ':delSkill' => $_POST['delSkill']
  );

  $pre = $pdo->prepare($sql);
  $pre->execute($dataBinded);

  header('Location:../admin.php');
  exit();
?>