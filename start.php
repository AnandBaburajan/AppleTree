<?php
session_start();
if($_SESSION["loggedin"] !== true){
   header("location: https://smashsdgs.me/");
   exit();
}
require $_SERVER['DOCUMENT_ROOT'].'/db_connect.php';
$mysqli = OpenCon();
$id = (int)$_SESSION["id"];
$q1 = "SELECT recom_set FROM users WHERE id = ?";
$stmt1 = $mysqli->prepare($q1);
$stmt1->bind_param("s", $id);
$stmt1->execute();
$rec = $stmt1->get_result();
$recom_set = $rec->fetch_array(MYSQLI_NUM);
$stmt1->close();
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
  <title>AppleTree</title>

  <!-- CSS  -->
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://smashsdgs.me/css/materialize.min.css">
  <link href="https://smashsdgs.me/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body class="white-back">
<header></header>

<main>
  <div class="container">
  <div class="section no-pad-bot logo-apple">
      <div class="row center">
        <img src="https://i.ibb.co/3pYyqRW/e.png" style="width:80%;" alt="AppleTree">
      </div>
      <div class="row center">
      <h5 class="header center grey-darken-4-text">Welcome</h1>
        <?php if($recom_set[0]!==1){
        echo "<p class='grey-darken-4-text'>Start smashing your SDGs</p>";
      }
      else {
        echo "<p class='grey-darken-4-text'>Continue smashing your SDGs</p>";
      }
      ?>
      </div>
      <div class="row center">
      <?php
      if($recom_set[0]!==1){
        echo "<a href='https://smashsdgs.me/recommend.php' class='btn-large white-text waves-effect waves- deep-purple darken-4'>Start</a>";
      }
      else {
        echo "<a href='https://smashsdgs.me/recommendations.php' class='btn-large white-text waves-effect waves- deep-purple darken-4'>Go</a>";
      }
      ?>
      </div>
      <br>
    </div>
  </div>
</main>
<footer>
    <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
    <li class="tab"><a class="active" href="https://smashsdgs.me/start.php"><i class="material-icons">home</i></a></li>
    <li class="tab"><a href="https://smashsdgs.me/dashboard"><i class="material-icons">dashboard</i></a></li>
    <li class="tab"><a href="https://smashsdgs.me/logout.php"><i class="material-icons">exit_to_app</i></a></li>
    </ul>
</footer>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://smashsdgs.me/js/materialize.min.js"></script>
  <script src="https://smashsdgs.me/js/init.js"></script>
  <script defer src="https://smashsdgs.me/site.js"></script>

  </body>
</html>
