<?php 
  require ('config/config.php'); 

  echo ($_SESSION['login'] == true && $_SESSION['role'] == 1) ? require ('view/vadmin.php') : "Vous n'êtes pas administrateur.";

?>