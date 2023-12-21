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
        <h1 class="title">Team list</h1>
      </div>
      
      <div class="player-container">
        <?php
        foreach($data as $dataPlayer){ ?>
          <div class="player-box">
            <img src="<?php echo $dataPlayer['profilepicture']; ?>" alt="Photo du joueur">
            <h2><?php echo $dataPlayer['player_name']; ?></h2>
            <p class="margin-bottom"><?php echo $dataPlayer['player_bio']; ?></p>
            <div class="flex-align">
              <a href="<?php echo $dataPlayer['twitter']; ?>" target="_blank">Twitter</a>
              <a class="margin-bottom" href="<?php echo $dataPlayer['linked_In']; ?>" target="_blank">LinkedIn</a>
            </div>
            <a class="see-button" href="esport-profile.php?id=<?php echo $dataPlayer['ID'];?>">See my profile</a>
          </div>
        <?php }
        ?>
      </div>
      
    </div>

  </body>
</html>