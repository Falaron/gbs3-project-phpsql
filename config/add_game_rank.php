<?php 
require_once "config.php";

$sqlInsert = "INSERT INTO GAMES(name, game_rank, ID_PLAYER) VALUES (:name, :game_rank, :ID_PLAYER)";

$dataBindedInsert = array(
    ':name' => $_POST['addGame'],
    ':game_rank' => $_POST['addRank'],
    ':ID_PLAYER' => $_GET['id']
);

$preInsert = $pdo->prepare($sqlInsert);
$preInsert->execute($dataBindedInsert);

header('Location: ../admin.php');
exit();
?>