<?php
  // to print bonjour depending on if you registered or logged in
  if (isset($_SESSION['user'][':username'])){
    $hello = $_SESSION['user'][':username'];
  } elseif (isset($_SESSION['user']['username'])){
    $hello = $_SESSION['user']['username'];
  }

     $sql = "SELECT * FROM PLAYER";
      $pre = $pdo->prepare($sql);
      $pre->execute();
      $data = $pre->fetchAll(PDO::FETCH_ASSOC);
  ?>

<!-- NAVBAR ON PC -->
<nav>
  <div class="container">
      <a href="index.php">Team Roster Pro</a>
      <ul>
      <?php
      foreach($data as $dataPlayer){ ?>
        <li><a href="esport-profile.php?id=<?php echo $dataPlayer['ID'];?>"><?php echo $dataPlayer['player_name'];?> Profile</a></li>
      <?php }
      ?>

        <!-- changing links according to if your are logged in, out, admin -->
        <?php if(isset($_SESSION['login']) && !$_SESSION['login']) {?>
          <li><a href='login.php'>Login</a></li>
          <li><a href='signup.php'>Signup</a></li>
        <?php }
        elseif (isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['role'] == 1) { ?>
            <li><a href='admin.php'>Admin Panel</a></li>
          <?php }
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) { ?>
            <li><a href='config/logout.php'>Logout</a></li>
          <?php } ?>
        

        <li><span> <?php echo (isset($_SESSION['login']) && $_SESSION['login'] == true) ? "Hello ".$hello : 'You are logged out'; ?> </span></li>  
      </ul>
  </div>
</nav>