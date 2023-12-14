<!DOCTYPE html>
<html lang="en" dir="ltr" id="index">
  <head>
    <title>Team Roster Pro</title>
    <meta name="description" content="Login to lead your Esport team now.">
    <meta charset="utf-8">
    <!-- Let browser know website is optimized for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Disable the cache to avoid versioning problems -->
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
  </head>

  <body>
    <?php
      $sql = "SELECT * FROM PLAYER";
      $pre = $pdo->prepare($sql);
      $pre->execute();
      $data = $pre->fetchAll(PDO::FETCH_ASSOC);
      ?>

    <!-- NAVBAR -->
    <?php require ('assets/parts/navbar.php');?>

    <div id="profile-container">
      <div id="header">
        <h1>Team list</h1>
      </div>
      
      <?php
      foreach($data as $dataPlayer){ ?>
        <div>
          <h2><?php echo $dataPlayer['player_name']; ?></h2>
          <p><?php echo $dataPlayer['player_bio']; ?></p>
          <img src="<?php echo $dataPlayer['profilepicture']; ?>" alt="Photo du joueur"width="150" height="220">
          <p>Twitter : <a href="https://twitter.com/<?php echo $dataPlayer['twitter']; ?>" target="_blank"><?php echo $dataPlayer['twitter']; ?></a></p>
          <p>LinkedIn : <?php echo $dataPlayer['linked_In']; ?></p>

          <a href="esport-profile.php?id=<?php echo $dataPlayer['ID'];?>">See my profile.</a>
      <?php }
      ?>
    </div>

  </body>
</html>