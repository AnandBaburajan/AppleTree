<?php
session_start();
if($_SESSION["loggedin"] !== true){
   header("location: https://smashsdgs.me/");
   exit();
}
require $_SERVER['DOCUMENT_ROOT'].'/db_connect.php';
$mysqli = OpenCon();
$id = (int)$_SESSION["id"];
$q2 = "SELECT progress FROM trees WHERE id = ?";
$stmt2 = $mysqli->prepare($q2);
$stmt2->bind_param("s", $id);
$stmt2->execute();
$pro = $stmt2->get_result();
$progress = $pro->fetch_array(MYSQLI_NUM);
$stmt2->close();

$q1 = "SELECT target FROM trees WHERE id = ?";
$stmt1 = $mysqli->prepare($q1);
$stmt1->bind_param("s", $id);
$stmt1->execute();
$tar = $stmt1->get_result();
$target = $tar->fetch_array(MYSQLI_NUM);
$stmt1->close();

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

$sq = "SELECT username, email FROM users WHERE id = ?";
$stm = $mysqli->prepare($sq);
$stm->bind_param("s", $id);
$stm->execute();
$stm->store_result();
$stm->bind_result($user, $email);
$stm->fetch();
$stm->close();

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
  <title>Dashboard | AppleTree</title>

  <!-- CSS  -->
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://smashsdgs.me/css/materialize.min.css">
  <link href="https://smashsdgs.me/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body class="white-back">
<header></header>
<div class="dashb section">
      <div class="row">
      <h4 class="header white-text">Dashboard</h4>
      </div>
</div>

<main>
  <div class="container">
    <div class="section">

      <h5>User</h5>
      <div class="card">
        <div class="card-content">
      <p>Username: <?php echo $user; ?></p>
      <p>Email: <?php echo $email; ?></p>
    </div>
  </div>

  <?php if($nouser==0 && $progress[0]<$target[0]){
    print'<br><h5>Actions in progress</h5>
      <div class="card">
        <a href="https://smashsdgs.me/progress/trees.php" class="btn-floating halfway-fab waves-effect waves-light grey darken-4"><i class="material-icons">play_arrow</i></a>
    <div class="card-content">
      <p>Plant a tree</p>
    </div>
  </div>';
}?>

<br>
  <h5>Credits</h5>
  <div class="card">
  <div class="card-content">
  <p><?php echo $progress[0]; ?></p>
  </div>
  </div>

    </div>
  </div>
</main>
<footer>
    <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
    <li class="tab"><a href="https://smashsdgs.me/start.php"><i class="material-icons">home</i></a></li>
    <li class="tab"><a class="active" href="https://smashsdgs.me/dashboard"><i class="material-icons">dashboard</i></a></li>
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
