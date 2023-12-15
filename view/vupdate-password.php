<!DOCTYPE html>
<html lang="en" dir="ltr" id="index">
  <head>
    <title>Team Roster Pro - Login</title>
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
      <?php require ('assets/parts/navbar.php');?>
      
  <div id="header">
    <h1>Esports Profile</h1>
  </div>

  <div id="form-container">
    <h2>Update Password</h2>
    <form id="update-password-form" action="#" method="post">
      <label for="new-password">New Password:</label>
      <input type="password" id="new-password" name="new-password" required>

      <label for="confirm-new-password">Confirm New Password:</label>
      <input type="password" id="confirm-new-password" name="confirm-new-password" required>

      <button type="submit">Update Password</button>
    </form>

    <a href="login.php" id="login-link">Remembered your password? Login</a>
  </div>
</body>
</html>