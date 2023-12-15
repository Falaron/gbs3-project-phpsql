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
     <!-- NAVBAR -->
     <?php require('assets/parts/navbar.php');
     require('config/image_detection.php')?>
     
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
                        <form action="config/edit_manager.php?id=<?php echo $managerInfo['ID'] ?>" method="POST">
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
     <!-- Player Tab -->
     <?php
        $sql = "SELECT * FROM PLAYER"; 
        $pre = $pdo->prepare($sql); 
        $pre->execute();
        $dataPlayer = $pre->fetchAll(PDO::FETCH_ASSOC); 
      ?>
      <div  id="PLAYER">
        <h2 >PLAYERS</h2>
        <ul >
          <?php foreach($dataPlayer as $playerInfos){ ?>
            <li>
              <div><h3 ><?php echo $playerInfos['player_name'] ?></h3></div>
              <div >
                <form method="post" action="config/delete_player.php">
                  <input type="hidden" name="delPlayer" value="<?php echo $playerInfos['ID']; ?>">
                  <button type="submit">Delete Player</button>
                </form>
                <p><?php echo $playerInfos['player_bio']; ?></p>
                <h4><?php echo $playerInfos['twitter']; ?></H4>
                <h4><?php echo $playerInfos['linked_In']; ?></H4>
                <ul>
                  <li>
                    <div>
                      <p>MODIFY CONTENT</p>
                    </div>
                    <div>
                      <div>
                      <form action="config/edit_player.php?id=<?php echo $playerInfos['ID'] ?>" method="POST">
                          <div>
                          <?php foreach($playerInfos as $playerKey => $playerInfo){
                            if(isImage($playerInfo) == true){ ?>
                              <div>
                                <div>
                                  <div>
                                      <span>File</span>
                                      <input type="file" name=<?php echo $playerKey ?>>
                                  </div>
                                  <div>
                                      <input type="text" name=<?php echo $playerKey ?> placeholder=<?php echo "'$playerKey'" ?>>
                                  </div>
                                </div>
                              </div>
                          <?php } else { 
                            if($playerKey == "ID") continue; ?>
                                <div>
                                  <div class="input-field col s12">
                                    <label for="name"><?php echo $playerKey ?></label>
                                    <textarea id="textarea1" class="materialize-textarea" name="<?php echo $playerKey; ?>"><?php echo $playerInfo; ?></textarea>
                                  </div>
                                </div>
                          <?php } 
                          } ?>
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
        <div>
          <button type="submit" data-target="modal-add-project">SAVE</button>
        </div>
      </div>
      
      <?php //require('assets/parts/project-add.php'); ?>
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