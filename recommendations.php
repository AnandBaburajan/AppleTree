<?php
session_start();
if (isset($_POST['go']))
{
  require $_SERVER['DOCUMENT_ROOT'].'/db_connect.php';
  $mysqli = OpenCon();
  $id = (int)$_SESSION["id"];
  $lat = (float)$_POST['lat'];
  $lon = (float)$_POST['lon'];
  $q1 = "UPDATE users SET recom_set=1,lat=?,lon=? WHERE id=?";
  $stmt1 = $mysqli->prepare($q1);
  $stmt1->bind_param("sss", $lat,$lon,$id);
  $stmt1->execute();
  $stmt1->close();
  CloseCon($mysqli);
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
  <title>Recommendations | AppleTree</title>

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
        <h5 class="header white-text">Recommended for you</h5>
        </div>
  </div>
<div class="container">
  <div class="section">

    <ul class="collapsible">
    <li class="active">
      <div class="collapsible-header"><i class="material-icons">chevron_right</i>Plant trees</div>
      <div class="collapsible-body"><span>If every one of us took a couple of hours to plant some trees, it would eventually reduce the carbon dioxide level drastically.</span>
        <br><br><a href="https://smashsdgs.me/actions/plant-a-tree.php" class="btn-floating btn waves-effect waves- deep-purple darken-4">
          <i class="material-icons">play_arrow</i></a>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">chevron_right</i>Recycle e-waste</div>
      <div class="collapsible-body"><span></span>
        <br><br><a href="#" class="btn-floating btn waves-effect waves- deep-purple darken-4">
          <i class="material-icons">play_arrow</i></a>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">chevron_right</i>Eat less meat</div>
      <div class="collapsible-body"><span></span>
        <br><br><a href="#" class="btn-floating btn waves-effect waves- deep-purple darken-4">
          <i class="material-icons">play_arrow</i></a>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">chevron_right</i>Shift to e-vehicles</div>
      <div class="collapsible-body"><span></span>
        <br><br><a href="#" class="btn-floating btn waves-effect waves- deep-purple darken-4">
          <i class="material-icons">play_arrow</i></a>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">chevron_right</i>Use solar panels</div>
      <div class="collapsible-body"><span></span>
        <br><br><a href="#" class="btn-floating btn waves-effect waves- deep-purple darken-4">
          <i class="material-icons">play_arrow</i></a>
      </div>
    </li>
  </ul>

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
