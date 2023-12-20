<?php 
require_once "config.php";

$sqlInsert = "INSERT INTO SKILLS(skill, ID_PLAYER) VALUES (:skill, :ID_PLAYER)";

$dataBindedInsert = array(
    ':skill' => $_POST['addSkill'],
    ':ID_PLAYER' => $_GET['id'],
);

$preInsert = $pdo->prepare($sqlInsert);
$preInsert->execute($dataBindedInsert);

header('Location: ../admin.php');
?>