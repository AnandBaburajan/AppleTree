<?php
session_start();
if($_SESSION["loggedin"] !== true){
   header("location: https://smashsdgs.me/");
   exit();
}
require $_SERVER['DOCUMENT_ROOT'].'/db_connect.php';
$mysqli = OpenCon();
$id = (int)$_SESSION["id"];
$nouser=0;
$sql = "SELECT * FROM trees WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows == 1)
{
  $nouser=0;
}
else {
  $nouser=1;
}
$stmt->close();

$q1 = "SELECT lon FROM users WHERE id = ?";
$stmt1 = $mysqli->prepare($q1);
$stmt1->bind_param("s", $id);
$stmt1->execute();
$lo = $stmt1->get_result();
$lon = $lo->fetch_array(MYSQLI_NUM);
$stmt1->close();

$q2 = "SELECT lat FROM users WHERE id = ?";
$stmt2 = $mysqli->prepare($q2);
$stmt2->bind_param("s", $id);
$stmt2->execute();
$la = $stmt2->get_result();
$lat = $la->fetch_array(MYSQLI_NUM);
$stmt2->close();

CloseCon($mysqli);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link rel="manifest" href="https://smashsdgs.me/manifest.json">
  <title>Plant a tree | AppleTree</title>

  <!-- CSS  -->
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://smashsdgs.me/css/materialize.min.css">
  <link href="https://smashsdgs.me/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <script src="https://cdn.plot.ly/plotly-1.2.0.min.js"></script>

</head>
<body class="white-back">
<header></header>
<main>
<div class="head-back section">
      <div class="row">
      <h4 class="header white-text">Plant a tree!</h4>
      </div>
</div>

    <div class="container">
      <div class="section">
        <?php if($nouser==0){
        print '<h5>Check your progress:</h5>
        <a class="btn-large waves-effect waves- deep-purple darken-4" href="https://smashsdgs.me/progress/trees.php">Go</a>';
      }
    ?><br><br>
      <div class="divider"></div>
        <h6><b>CO2 Level at your location: <span id="co2" class="deep-purple-text"></span> ppm</b></h6><br>

        <div id="lat-div" style="display: none;"><?php echo htmlspecialchars($lat[0]); ?></div>
        <div id="lon-div" style="display: none;"><?php echo htmlspecialchars($lon[0]); ?></div>
  <script src="https://smashsdgs.me/js/vis.js"></script>
      <div id="myDiv" class="flexhaha"></div>
      <span><i>OCO-2 (Orbiting Carbon Observatory-2) 9 LITE</i></span>
      <p>The map shows space-based global measurements of atmospheric CO2 measured from Aug - Sep 2019.
      </p>
      <div class="divider"></div>
      <div class="row">
      <h6><b>Vegetation index of your location: <span id="veg" class="deep-purple-text"></span></b></h6><br>
      <img class="responsive-img" src="https://smashsdgs.me/data/veg.jpg">
      <span><i>MODIS/Terra Vegetation Indices Monthly L3 Global 0.05 Deg CMG</i></span>
      <p>This vegetation index map show where and how much green leaf vegetation was growing during Sep 2019.</p>
      </div>


      <div class="divider"></div>

      <?php if($nouser!=0){
      print '<h5>Start planting now!</h5>
      <p>Number of trees I will plant by 2025:</p>
      <form action="https://smashsdgs.me/progress/trees.php" method="post">
        <p><label>
          <input type="radio" name="trees" value="10"/>
          <span>10</span>
        </label></p>
        <p><label>
          <input type="radio" name="trees" value="50"/>
          <span>50</span>
        </label></p>
        <p><label>
          <input type="radio" name="trees" value="100"/>
          <span>100</span>
        </label></p>
      <button type="submit" class="full-btn btn-large waves-effect waves- deep-purple darken-4" name="start" value="start">Start</button>
    </form>';
  }
  ?>

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
