<?php
session_start();
if($_SESSION["loggedin"] !== true){
   header("location: https://smashsdgs.me/");
   exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link rel="manifest" href="https://smashsdgs.me/manifest.json">
  <title>Recommend | AppleTree</title>

  <!-- CSS  -->
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://smashsdgs.me/css/materialize.min.css">
  <link href="https://smashsdgs.me/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body class="white-back">
<header></header>
<main>
<div class="head-back section">
      <div class="row">
      <h5 class="header white-text">Get the best actions for you</h5>
        <p class="white-text">Tell us a bit about you:</p>
      </div>
  </div>
<div class="container">

  <div class="section">

    <h5>Enter your location:</h5>
    <button onclick="getLocation()" class="btn black-text waves-effect waves- white">Use GPS</button>
      <span id="geo_er"></span>
      <form action="https://smashsdgs.me/recommendations.php" method="post">
        <div class="row">
        <div class="input-field col s6">
          <input placeholder="Latitude" id="lat" name="lat" type="text" required>
        </div>
        <div class="input-field col s6">
          <input placeholder="Longitude" id="lon" name="lon" type="text" required>
        </div>
      </div>


<script>
var lat = document.getElementById("lat");
var lon = document.getElementById("lon");
var geo_er = document.getElementById("geo_er");
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    geo_er.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  lat.value = position.coords.latitude;
  lon.value = position.coords.longitude;
}
</script>
    <h5>Choose what defines you:</h5>
    <br>

        <div class="row">
        <label class="label-for-cbox">
          <input type="checkbox" class="cbox" name="checkbox" value="Student"/>

                      <div class="col s6">
                          <div class="recom card-panel">
                            <span class="white-text">Student</span>
                          </div>
                      </div>

        </label>
        <label class="label-for-cbox">
          <input type="checkbox" class="cbox" name="checkbox" value="Professional"/>

              <div class="col s6">
                  <div class="recom card-panel">
                    <span class="white-text">Professional</span>
                  </div>
              </div>

        </label>
        </div>

        <div class="row">
        <label class="label-for-cbox">
          <input type="checkbox" class="cbox" name="checkbox" value="Rural"/>

                      <div class="col s6">
                          <div class="recom card-panel">
                            <span class="white-text">Rural Area</span>
                          </div>
                      </div>

        </label>
        <label class="label-for-cbox">
          <input type="checkbox" class="cbox" name="checkbox" value="Urban"/>

              <div class="col s6">
                  <div class="recom card-panel">
                    <span class="white-text">Urban Area</span>
                  </div>
              </div>

        </label>
        </div>

      <button class="full-btn btn-large black-text waves-effect waves- white" type="submit" name="go" value="go">Go</button>

</form>
<br>
  </div>
  </div>
</main>


  <footer>
      <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
      <li class="tab"><a href="https://smashsdgs.me/start.php"><i class="material-icons">home</i></a></li>
      <li class="tab"><a href="https://smashsdgs.me/dashboard"><i class="material-icons">dashboard</i></a></li>
      <li class="tab"><a href="https://smashsdgs.me/logout.php"><i class="material-icons">exit_to_app</i></a></li>
      </ul>
  </footer>

  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://smashsdgs.me/js/materialize.min.js"></script>
  <script src="https://smashsdgs.me/js/init.js"></script>
  <script defer src="https://smashsdgs.me/site.js"></script>

  </body>
</html>
