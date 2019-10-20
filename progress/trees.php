<?php
 session_start();
 require $_SERVER['DOCUMENT_ROOT'].'/db_connect.php';
 $mysqli = OpenCon();
 $id = (int)$_SESSION["id"];
 if (isset($_POST['start']))
 {
   $target = (int)$_POST['trees'];
   $sql = "INSERT INTO trees (id, target, progress) VALUES($id,$target,0)";

   if($mysqli->query($sql)===TRUE)
   {
     $_SESSION['message']='Successful!';
     header("location: https://smashsdgs.me/progress/trees.php");
   }
   else {
     $_SESSION['message']= 'Failed';
   }
 }
 elseif (isset($_POST['submit']))
 {
   $count = (int)$_POST['num_trees'];
   $q1 = "UPDATE trees SET progress=progress + ? WHERE id=?";
   $stmt1 = $mysqli->prepare($q1);
   $stmt1->bind_param("ss", $count, $id);
   $stmt1->execute();
   $stmt1->close();
   header("location: https://smashsdgs.me/congrats.php");
 }
 else {
   $q1 = "SELECT target FROM trees WHERE id = ?";
   $stmt1 = $mysqli->prepare($q1);
   $stmt1->bind_param("s", $id);
   $stmt1->execute();
   $tar = $stmt1->get_result();
   $target = $tar->fetch_array(MYSQLI_NUM);
   $stmt1->close();

   $q2 = "SELECT progress FROM trees WHERE id = ?";
   $stmt2 = $mysqli->prepare($q2);
   $stmt2->bind_param("s", $id);
   $stmt2->execute();
   $pro = $stmt2->get_result();
   $progress = $pro->fetch_array(MYSQLI_NUM);
   $stmt2->close();
 }
 $val = ((int)$progress[0]*100)/(int)$target[0];
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
  <title>Progress - Plant a tree | AppleTree</title>

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
      <h4 class="header white-text">Plant a tree!</h4>
      </div>
</div>


    <div class="container">
      <div class="section">

      <h5>Your Progress</h5>
      <div class="progress">
        <div class="determinate" style="width: <?php print $val; ?>%"></div>
      </div>
      <h6><?php print $progress[0]; ?>/<?php print $target[0]; ?> trees</h6>
      <br><br>

      <?php if($progress[0]>=$target[0]){
      print "<h4>Congratulations!</h4>
      <h5>You've completed the action!</h5>";
    }
    else {
      print'
      <h5>Add trees</h5>
      <form class="col s12" method="post" action="https://smashsdgs.me/progress/trees.php">
        <div class="row">
          <div class="input-field col s12">
            <input id="num_trees" name="num_trees" type="text" class="validate" placeholder="Number of trees you planted recently">
          </div>
        </div>
        <button type="submit" class="full-btn btn-large waves-effect waves- deep-purple darken-4" name="submit" value="submit">Submit</button>
      </form>';
    }
    ?>
        

    <br><br>
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
