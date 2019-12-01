<?php
 session_start();
 if($_SESSION["loggedin"] === true){
    header("location: https://smashsdgs.me/start.php");
    exit();
 }
 require $_SERVER['DOCUMENT_ROOT'].'/db_connect.php';
 $_SESSION['message']='';
 $mysqli = OpenCon();
 $reg_flag=0;
if (isset($_POST['register']))
{
  $username = $mysqli->real_escape_string($_POST['username']);
  $email = $mysqli->real_escape_string($_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $user_check = "SELECT id, username, password FROM users WHERE username = ?";

  if($stmt = $mysqli->prepare($user_check)){
    $stmt->bind_param("s", $param_username);
    $param_username = $username;
    if($stmt->execute())
    {
        $stmt->store_result();
        if($stmt->num_rows != 1)
        {

          $_SESSION['username']=$username;
          $sql = "INSERT INTO users (username, email, password, recom_set, points, lat, lon)
          VALUES('$username','$email','$password',0,0,0,0)";

          if($mysqli->query($sql)===TRUE)
          {
            session_start();
            $_SESSION["id"] = $id;
            header("location: https://smashsdgs.me/index.php");
            exit();
          }
          else {
            $_SESSION['message']= 'Failed';
          }

        } else
        {
          $reg_flag=1;
        }
    } else{
          $reg_flag=2;
          }
  }

$stmt->close();
}
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
  <title>Register | AppleTree</title>

  <!-- CSS  -->
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://smashsdgs.me/css/materialize.min.css">
  <link href="https://smashsdgs.me/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body class="back-home">
<header>
</header>

<main>
  <div class="section no-pad-bot logo-apple">
    <div class="container">
      <div class="row center">
        <img src="https://smashsdgs.me/images/icon-512.png" style="width:60%;" alt="AppleTree">
      </div>
      <br>
    </div>
  </div>

  <div class="section no-pad-bot index-login">
    <div class="container">
      <?php
      if($reg_flag==1){echo "<span class='red-text'>Please try another username.</span>";}
      if($reg_flag==2){echo "<span class='red-text'>Oops! Something went wrong. Please try again later.</span>";}
       ?>
          <form class="col s12" method="post" action="https://smashsdgs.me/register.php">
            <div class="row">
              <div class="input-field col s12">
                <input id="username" name="username" type="text" class="validate" placeholder="Username" required>
                <input id="email" name="email" type="email" class="validate" placeholder="Email" required>
                <input id="password" name="password" type="password" class="validate" placeholder="Password" required>
                <button type="submit" class="full-btn btn-large waves-effect waves- deep-purple darken-4" name="register" value="register">Register</button>
              </div>
            </div>
            </form>

    </div>
  </div>
</main>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://smashsdgs.me/js/materialize.min.js"></script>
  <script src="https://smashsdgs.me/js/init.js"></script>
  <script defer src="https://smashsdgs.me/site.js"></script>

  </body>
</html>
