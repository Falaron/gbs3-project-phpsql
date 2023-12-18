<!DOCTYPE html>
<html lang="en" dir="ltr" id="index">
  <head>
    <title>Team Roster Pro - Forgot Password</title>
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
    <?php require('assets/parts/navbar.php');?>

    <div id="header">
      <h1>Esports Profile</h1>
    </div>

    <div id="form-container">
      <h2>Forgot Password</h2>
      <form id="forgot-password-form" action="forgot_password.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <button type="submit">Reset Password</button>
      </form>

      <a href="login.php" id="login-link">Remembered your password? Login</a>
    </div>
  </body>
</html>