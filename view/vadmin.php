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
    <!-- Tab links -->
    <div class="tab">
      <button class="tablinks" onclick="openBox(event, 'MANAGERS')">MANAGERS</button>
      <button class="tablinks" onclick="openBox(event, 'PLAYERS')">PLAYERS</button>
    </div>

    <!-- Tab content -->
    <div id="MANAGERS" class="tabcontent">
      <h3>MANAGERS</h3>
      <p>London is the capital city of England.</p>
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