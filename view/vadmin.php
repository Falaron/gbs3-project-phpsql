<!DOCTYPE html>
<html lang="en" dir="ltr" id="index">
  <head>
    <title>Team Roster Pro - Admin Panel</title>
    <meta name="description" content="Login to lead your Esport team now.">
    <meta charset="utf-8">
    <!-- Let browser know website is optimized for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="assets/css/style.css">
  </head>

  <body id="header">
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
        <ul class="no-deco">
          <?php foreach($dataManager as $managerInfo){ ?>
            <li class="super-margin">
              <div><h3><?php echo $managerInfo['username'] ?></h3></div>
              <div>
                <form method="post" action="config/delete_manager.php">
                  <input type="hidden" name="delManager" value="<?php echo $managerInfo['ID']; ?>">
                  <button type="submit">Delete Manager</button>
                </form>
                <ul>
                  <li><p>EMAIL : <?php echo $managerInfo['mail']; ?></p></li>
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
                              if($managerKey == "ID" || $managerKey == "manager_password") continue; ?>
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

        $sql = "SELECT * FROM SKILLS"; 
        $pre = $pdo->prepare($sql); 
        $pre->execute();
        $dataSkills = $pre->fetchAll(PDO::FETCH_ASSOC); 

        $sql = "SELECT * FROM GAMES"; 
        $pre = $pdo->prepare($sql); 
        $pre->execute();
        $dataGames = $pre->fetchAll(PDO::FETCH_ASSOC); 

      ?>
      <div  id="PLAYER">
        <h2 >PLAYERS</h2>
        <ul>
          <?php foreach($dataPlayer as $playerInfos) { ?>
            <li class="super-margin">
              <div><h3 ><?php echo $playerInfos['player_name'] ?></h3></div>
                <ul>
                  <li>
                    <div>
                      <p>MODIFY CONTENT</p>
                    </div>
                    <div>
                      <!-- MODIFY PLAYER INFOS -->
                      <form method="post" action="config/delete_player.php">
                          <input type="hidden" name="delPlayer" value="<?php echo $playerInfos['ID']; ?>">
                          <button type="submit">Delete Player /!\</button>
                      </form>
                      <form action="config/edit_player.php?id=<?php echo $playerInfos['ID'] ?>" method="POST" enctype="multipart/form-data">
                        <?php foreach($playerInfos as $playerKey => $playerInfo) {
                            if (isImage($playerInfo)) { ?>
                                <div>
                                    <div>
                                        <label for="<?php echo $playerKey ?>"><?php echo $playerKey ?></label>
                                        <input type="file" name="<?php echo $playerKey; ?>">
                                        <img src="<?php echo $playerInfos['profilepicture']; ?>" alt="Photo du joueur" width="150" height="220">
                                    </div>
                                </div>
                            <?php } else {
                                if ($playerKey == "ID") continue; ?>
                                <div>
                                    <div>
                                        <label for="<?php echo $playerKey ?>"><?php echo $playerKey ?></label>
                                        <textarea id="textarea1" name="<?php echo $playerKey; ?>" id="addSkill"><?php echo $playerInfo; ?></textarea>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                        <button type="submit">SAVE PLAYER INFOS</button>
                      </form>
                        
                      <!-- MODIFY OR ADD SKILL -->
                      <!-- <form action="config/edit_skill.php?id=<?php echo $playerInfos['ID'] ?>" method="POST" enctype="multipart/form-data"> -->
                        <?php foreach ($dataSkills as $skillsInfos) {
                        if ($skillsInfos['ID_PLAYER'] == $playerInfos['ID']) { ?>
                            <label for="skill_<?php echo $skillsInfos['ID']; ?>">Skill:</label>
                            <textarea id="skill_<?php echo $skillsInfos['ID']; ?>" name="skills[<?php echo $skillsInfos['ID']; ?>]"><?php echo $skillsInfos['skill']; ?></textarea>
                            <!-- Delete skill -->
                            <form method="post" action="config/delete_skill.php">
                              <input type="hidden" name="delSkill" value="<?php echo $skillsInfos['ID']; ?>">
                              <button type="submit">Delete Skill</button>
                            </form>
                        <?php }
                        } ?>
                        
                        <!-- New skill input -->
                        <label for="skill_new">New Skill:</label>
                        <form method="post" action="config/add_skill.php?id=<?php echo $playerInfos['ID']?>">
                          <input type="text" name="addSkill" id="addSkill" required>
                          <button type="submit">Add Skill</button>
                        </form>
                        <!-- <button type="submit">SAVE PLAYER SKILLS</button> -->
                      <!-- </form> -->
                            
                      <!-- MODIFY OR ADD GAME -->
                      <!-- <form action="config/edit_games_ranks.php?id=<?php echo $playerInfos['ID'] ?>" method="POST" enctype="multipart/form-data"> -->
                        <?php
                        foreach ($dataGames as $gamesInfos) {
                        if ($gamesInfos['ID_PLAYER'] == $playerInfos['ID']) { ?>
                            <label for="game_<?php echo $gamesInfos['ID']; ?>">Game:</label>
                            <textarea id="game_<?php echo $gamesInfos['ID']; ?>" name="game[<?php echo $gamesInfos['ID']; ?>]"><?php echo $gamesInfos['name']; ?></textarea>
                            <label for="rank_<?php echo $gamesInfos['ID']; ?>">Rank :</label>
                            <textarea id="rank_<?php echo $gamesInfos['ID']; ?>" name="rank[<?php echo $gamesInfos['ID']; ?>]"><?php echo $gamesInfos['game_rank']; ?></textarea>
                            <!-- Delete Game & Rank -->
                            <form method="post" action="config/delete_game_rank.php">
                              <input type="hidden" name="delGameRank" value="<?php echo $gamesInfos['ID']; ?>">
                              <button type="submit">Delete Game & Rank</button>
                            </form>
                        <?php }
                        } ?>
                        <!-- New Game & Rank inputs -->
                        <form method="post" action="config/add_game_rank.php?id=<?php echo $playerInfos['ID']?>">
                          <label for="game_new">New Game:</label>
                          <input type="text" name="addGame" id="addGame" required>
                          <label for="rank_new">Game Rank:</label>
                          <input type="text" name="addRank" id="addRank" required>
                          <button type="submit">Add Game & Rank</button>
                        </form>
                        <!-- <button type="submit">SAVE PLAYER GAMES & RANKS</button> -->
                      <!-- </form> -->
                    </div>
                  </li>
                </ul>
              </div>
            </li>
          <?php } ?>
          <div>
              <h2>Add your own player!</h2>
              <form action="config/add_player.php" method="POST" enctype="multipart/form-data">
                <div>
                  <?php foreach($dataPlayer[0] as $playerKey => $playerInfo){
                    if (isImage($playerInfo)) { ?>
                      <div>
                          <div>
                              <label for="<?php echo $playerKey ?>"><?php echo $playerKey ?></label>
                              <input type="file" name="profile_picture">
                          </div>
                      </div>
                  <?php } else {
                        if ($playerKey == "ID") continue; ?>
                        <div>
                          <div>
                            <label for="name"><?php echo $playerKey ?></label>
                            <textarea id="textarea1" name="<?php echo $playerKey; ?>"></textarea>
                          </div>
                        </div>
                  <?php } 
                  } ?>
                </div>
                
                <button type="submit">CREATE PLAYER</button>
              </form>
            </div>
        </ul>
      </div>
  </body>

  <script>
    function addGame() {
      const gamesContainer = document.getElementById('games-container');
      const newGameInput = document.createElement('div');
      newGameInput.className = 'game-input';
      const newGameNumber = gamesContainer.children.length + 1;
      newGameInput.innerHTML = `
        <label for="game${newGameNumber}">Game ${newGameNumber}:</label>
        <input type="text" class="game" name="games['name'][]" required>
        <input type="text" class="rank" name="games['rank'][]" >
        <button type="button" class="remove-btn" onclick="removeGame(this)">Remove</button>
      `;
      gamesContainer.appendChild(newGameInput);

      // Enable the remove button in the existing game input
      const existingGameInput = gamesContainer.querySelector('.game-input');
      if (existingGameInput) {
        const removeBtn = existingGameInput.querySelector('.remove-btn');
        removeBtn.removeAttribute('disabled');
      }
    }

    function removeGame(button) {
      const gamesContainer = document.getElementById('games-container');
      const gameInput = button.parentNode;
      gamesContainer.removeChild(gameInput);

      // Disable the remove button if there is only one game
      const remainingGameInputs = gamesContainer.children.length;
      if (remainingGameInputs === 1) {
        const removeBtn = gamesContainer.querySelector('.remove-btn');
        removeBtn.setAttribute('disabled', 'disabled');
      }
    }

    function addSkill() {
      const skillsContainer = document.getElementById('skills-container');
      const newSkillInput = document.createElement('div');
      newSkillInput.className = 'skill-input';
      const newSkillNumber = skillsContainer.children.length + 1;
      newSkillInput.innerHTML = `
        <label for="skill${newSkillNumber}">Skill ${newSkillNumber}:</label>
        <input type="text" class="skill" name="skills[]" required>
        <button type="button" class="remove-btn" onclick="removeSkill(this)">Remove</button>
      `;
      skillsContainer.appendChild(newSkillInput);

      // Enable the remove button in the existing skill input
      const existingSkillInput = skillsContainer.querySelector('.skill-input');
      if (existingSkillInput) {
        const removeBtn = existingSkillInput.querySelector('.remove-btn');
        removeBtn.removeAttribute('disabled');
      }
    }

    function removeSkill(button) {
      const skillsContainer = document.getElementById('skills-container');
      const skillInput = button.parentNode;
      skillsContainer.removeChild(skillInput);

      // Disable the remove button if there is only one skill
      const remainingSkillInputs = skillsContainer.children.length;
      if (remainingSkillInputs === 1) {
        const removeBtn = skillsContainer.querySelector('.remove-btn');
        removeBtn.setAttribute('disabled', 'disabled');
      }
    }

    function copyContent() {
      // Get the content from the textarea
      var bioTextarea = document.getElementById('player-bio');
      var bioHiddenInput = document.getElementById('hidden-player-bio');

      // Set the value of the hidden input to the textarea content
      bioHiddenInput.value = bioTextarea.value;
    }

    // Trigger copyContent when the textarea loses focus
    document.getElementById('player-bio').addEventListener('blur', copyContent);
  </script>
  <script> 
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