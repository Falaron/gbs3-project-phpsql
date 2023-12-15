<!DOCTYPE html>
<html lang="en" dir="ltr" id="index">
  <head>
    <title>Team Roster Pro - Admin Panel</title>
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
    <h1>ADMIN PANEL</h1>

    <!-- Tab links -->
    <div class="tab">
      <button class="tablinks" onclick="openBox(event, 'MANAGERS')">MANAGERS</button>
      <button class="tablinks" onclick="openBox(event, 'PLAYERS')">PLAYERS</button>
    </div>

    <!-- Manager Tab content -->
    <div id="MANAGERS" class="tabcontent">
      <!-- User Tab -->
      <?php
        $sql = "SELECT * FROM MANAGER"; 
        $pre = $pdo->prepare($sql); 
        $pre->execute();
        $dataManager = $pre->fetchAll(PDO::FETCH_ASSOC); 
      ?>

      <div id="theManagers">
        <h2>MANAGERS</h2>
        <ul>
          <?php foreach($dataManager as $managerInfo){ ?>
            <li>
              <div><h3><?php echo $managerInfo['username'] ?></h3></div>
              <div>
                <form method="post" action="config/delete_manager.php">
                  <input type="hidden" name="delManager" value="<?php echo $managerInfo['ID']; ?>">
                  <button type="submit">Delete Manager</button>
                </form>
                <ul>
                  <li><p>EMAIL : <?php echo $managerInfo['mail']; ?></p></li>
                  <li><p>PASSWORD : <?php echo $managerInfo['manager_password']; ?></p></li>
                  <li><p>USER ROLE : <?php echo ($managerInfo['manager_role']) ? 'Admin' : 'Non Admin'; ?></p></li>
                </ul>
                <ul>
                  <li>
                    <div>
                      <p>MODIFY CONTENT</p>
                    </div>
                    <div>
                      <div>
                        <form action="config/edit_user.php?id=<?php echo $managerInfo['ID'] ?>" method="POST">
                          <div>
                            <?php foreach($managerInfo as $managerKey => $userInfo){ 
                              if($managerKey == "ID") continue; ?>
                              <div>
                                <label for="name"><?php echo $managerKey ?></label>
                                <textarea id="textarea3" name="<?php echo $managerKey ?>"><?php echo $userInfo; ?></textarea>
                              </div>
                            <?php } ?>
                          </div>
                          <button type="submit">SAVE</button>
                        </form>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>

    <div id="PLAYERS" class="tabcontent">
      <h3>PLAYERS</h3>
      <p>Paris is the capital of France.</p>
    </div>
  </body>

  <script type="text/javascript"> 
  function openBox(evt, category) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(category).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
</html>