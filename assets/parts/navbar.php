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
<a div class="header">
    <nav class="navbar">
        <a href="index.php" class="logo">Team Rooster Pro</a>

        <?php if(isset($_SESSION['login']) && !$_SESSION['login']) {?>
          <a href='login.php'>Login</a>
          <a href='signup.php'>Signup</a>
        <?php }
        elseif (isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['role'] == 1) { ?>
          <a href='admin.php'>Admin Panel</a>
          <?php }
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) { ?>
          <a href='forgot-password.php'>Forgot Password</a>
          <a href='config/logout.php'>Logout</a>
          <?php } ?>
        

        <span> <?php echo (isset($_SESSION['login']) && $_SESSION['login'] == true) ? "Hello ".$hello : 'You are logged out'; ?> </span></li>
    </nav> 
      <ul>
      <?php
      //foreach($data as $dataPlayer){ ?>
        <!-- <a href="esport-profile.php?id=<?php //echo $dataPlayer['ID'];?>"><?php// echo $dataPlayer['player_name'];?> Profile</a> -->
  </div>
</nav>