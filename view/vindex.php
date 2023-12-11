<!DOCTYPE html>
<html lang="en" dir="ltr" id="index">
  <head>
    <title>Team Roster Pro</title>
    <meta name="description" content="Lead your Esport team now.">
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
      $sql = "SELECT * FROM managers";
      $pre = $pdo->prepare($sql);
      $pre->execute();
      $data = $pre->fetch(PDO::FETCH_ASSOC);
    ?>

    <h1>Hello G.BS3</h1>
    <p><?php echo "Arthur is a goat!" ?></p>
    <p><?php echo $data['first_name	']; ?></p>
  </body>
</html>