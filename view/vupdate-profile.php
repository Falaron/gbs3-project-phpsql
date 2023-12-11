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
  <div id="header">
    <h1>Esports Profile</h1>
  </div>
  <div><a href="profile.html">Go to profile</a></div>
  <form>
    <div id="player-info">
      <h2>Player Information</h2>
      <label for="player-name">Player Name:</label>
      <input type="text" id="player-name" name="player-name" required value="John 'Enigma' Doe">

      <label for="player-image">Player Image:</label>
      <input type="file" id="player-image" name="player-image">

      <label for="twitter">Twitter:</label>
      <input type="text" id="twitter" name="twitter" value="https://twitter.com">

      <label for="linkedin">LinkedIn:</label>
      <input type="text" id="linkedin" name="linkedin" value="https://linkedin.com">
    </div>

    <div id="games">
      <h3>Games</h3>
      <div id="games-container">
        <!-- Initial game input field -->
        <div class="game-input">
          <label for="game1">Game 1:</label>
          <input type="text" class="game" name="games[]" required value="Super Smash Bros. Ultimate">
          <!-- Remove button is disabled when there is only one game -->
          <button type="button" class="remove-btn" onclick="removeGame(this)" disabled>Remove</button>
        </div>
      </div>
      <button type="button" onclick="addGame()">Add Game</button>
    </div>

    <div id="skills">
      <h3>Skills</h3>
      <div id="skills-container">
        <!-- Initial skill input field -->
        <div class="skill-input">
          <label for="skill1">Skill 1:</label>
          <input type="text" class="skill" name="skills[]" required value="Strong team player with excellent communication skills">
          <!-- Remove button is disabled when there is only one skill -->
          <button type="button" class="remove-btn" onclick="removeSkill(this)" disabled>Remove</button>
        </div>
      </div>
      <button type="button" onclick="addSkill()">Add Skill</button>
    </div>

    <!-- Your existing HTML code here -->

    <button type="submit">Save Profile</button>
  </form>

  <script>
    // Your existing JavaScript code here

    function addGame() {
      const gamesContainer = document.getElementById('games-container');
      const newGameInput = document.createElement('div');
      newGameInput.className = 'game-input';
      const newGameNumber = gamesContainer.children.length + 1;
      newGameInput.innerHTML = `
        <label for="game${newGameNumber}">Game ${newGameNumber}:</label>
        <input type="text" class="game" name="games[]" required>
        <button type="button" class="remove-btn" onclick="removeGame(this)">Remove</button>
      `;
      gamesContainer.appendChild(newGameInput);

      // Enable the Remove button in the existing game input
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

      // Disable the Remove button if there is only one game
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

      // Enable the Remove button in the existing skill input
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

      // Disable the Remove button if there is only one skill
      const remainingSkillInputs = skillsContainer.children.length;
      if (remainingSkillInputs === 1) {
        const removeBtn = skillsContainer.querySelector('.remove-btn');
        removeBtn.setAttribute('disabled', 'disabled');
      }
    }
  </script>
</body>
</html>