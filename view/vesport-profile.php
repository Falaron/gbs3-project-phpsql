<!DOCTYPE html>
<html lang="en" dir="ltr" id="index">
  <head>
    <title>Team Roster Pro - Play Profile</title>
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
    <!-- NAVBAR -->
    <?php
      require ('assets/parts/navbar.php');
      $pageid = $_GET['id'];

      $sql = "SELECT * FROM PLAYER WHERE ID = $pageid";
      $pre = $pdo->prepare($sql);
      $pre->execute();
      $data = $pre->fetch(PDO::FETCH_ASSOC);
    ?>
    
    
    <div id="profile-container">
      <div id="header">
        <h1>Esports Profile</h1>
    </div>

    <div id="player-info">
      <div id="player-section">
        <h2><?php echo $data['player_name']; ?></h2>
        <div class="best-rank">12th Valorant</div>
        <div class="player-image">
        <img src="<?php echo $data['profilepicture']; ?>" alt="Photo du joueur"width="150" height="220">
      </div>
      </div>
      <div id="about-me">
        <h2>About Me</h2>
        <p><?php echo $data['player_bio']; ?></p>
      </div>
    </div>

      <!-- RANKING SECTION -->
      <?php require ('assets/parts/show-games.php');?>

      <!-- SKILLS SECTION -->
      <?php require ('assets/parts/show-skills.php');?>

      <div id="footer">
        <div id="social-links">
        <p>Twitter : <a href="https://twitter.com/<?php echo $data['twitter']; ?>" target="_blank"><?php echo $data['twitter']; ?></a></p>
        <p>LinkedIn : <?php echo $data['linked_In']; ?></p>
        </div>
      </div>
    </div>
  </body>
</html>