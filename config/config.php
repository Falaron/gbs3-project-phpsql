<?php
  $pdo = new PDO(
    'mysql:host=mysql-team-roster-pro.alwaysdata.net;dbname=team-roster-pro_database;',
    '339632',
    'Super@0Groupe!',
    array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
?>