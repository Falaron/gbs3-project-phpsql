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
    <!-- <?php
      //$sql = "SELECT * FROM managers";
      //$pre = $pdo->prepare($sql);
      //$pre->execute();
      //$data = $pre->fetch(PDO::FETCH_ASSOC);
    ?>
    <p><?php //echo $data['first_name']; ?></p> -->

    <div id="header">
    <h1>Esports Profile</h1>
    </div>

    <div id="form-container">
      <h2>Login</h2>
      <form id="login-form" action="#" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
      </form>

      <a href="signup.html" id="signup-link">Don't have an account? Sign Up</a>
      <a href="forgot-password.html" id="forgot-password">Forgot password?</a>
    </div>
  </body>
</html>