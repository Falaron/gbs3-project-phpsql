<?php
  // to print bonjour depending on if you registered or logged in
  if (isset($_SESSION['user'][':username'])){
    $hello = $_SESSION['user'][':username'];
  } elseif (isset($_SESSION['user']['username'])){
    $hello = $_SESSION['user']['username'];
  }
  ?>

<!-- NAVBAR ON PC -->
<nav>
  <div class="container">
      <a href="index.php">Team Roster Pro</a>
      <ul>
        <li><a href="esport-profile.php">Profile 1</a></li>
        
        <!-- changing links according to if your are logged in, out, admin -->
        <?php if(isset($_SESSION['login']) && !$_SESSION['login']) {?>
          <li><a href='login.php'>Login</a></li>
        <?php }
        elseif (isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['role'] == 1) { ?>
            <li><a href='#'>Admin Panel</a></li>
          <?php }
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) { ?>
            <li><a href='config/logout.php'>Logout</a></li>
          <?php } ?>

        <li><span> <?php echo (isset($_SESSION['login']) && $_SESSION['login'] == true) ? "Hello ".$hello : 'You are logged out'; ?> </span></li>  
      </ul>
  </div>
</nav>