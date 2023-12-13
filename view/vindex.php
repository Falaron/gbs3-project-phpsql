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

    <div id="profile-container">
      <div id="header">
        <h1>Team list</h1>
      </div>
      
      <?php
      foreach($data as $dataPlayer){ ?>
        <div>
          <h2><?php echo $dataPlayer['player_name']; ?></h2>
          <p><?php echo $dataPlayer['player_bio']; ?></p>
          <a href="<?php echo $dataPlayer['twitter']; ?>"><?php echo $dataPlayer['twitter']; ?></a>
        </div>
      <?php }
      ?>
    </div>

  </body>
</html>