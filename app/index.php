<?php
session_start();
if($_SESSION["loggedin"] === true){
   header("location: https://smashsdgs.me/start.php");
   exit();
}
if (isset($_POST['login']))
{
  $auth_flag=0;
  require $_SERVER['DOCUMENT_ROOT'].'/db_connect.php';
  $_SESSION['message']='';
  $mysqli = OpenCon();
  $username = $mysqli->real_escape_string($_POST['username']);
  $password = $_POST['password'];

  $sql = "SELECT id, username, password FROM users WHERE username = ?";

          if($stmt = $mysqli->prepare($sql)){
              $stmt->bind_param("s", $param_username);
              $param_username = $username;
              if($stmt->execute())
              {
                  $stmt->store_result();
                  if($stmt->num_rows == 1)
                  {
                      $stmt->bind_result($id, $username, $hashed_password);
                      if($stmt->fetch()){
                          if(password_verify($password, $hashed_password)){
                              session_start();
                              $_SESSION["loggedin"] = true;
                              $_SESSION["id"] = $id;
                              $_SESSION["username"] = $username;
                              header("location: https://smashsdgs.me/start.php");
                          } else
                          {
                              $auth_flag=1;
                          }
                      }
                  } else
                  {
                      $auth_flag=2;
                  }
              } else{
                  echo "<span>Oops! Something went wrong. Please try again later.</span>";
              }
          }

          $stmt->close();
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
  <title>Login | AppleTree</title>

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
      if($auth_flag==1){echo "<span class='red-text'>The password you entered was not valid.</span>";}
      if($auth_flag==2){echo "<span class='red-text'>No account found with that username.</span>";}
       ?>
      <form class="col s12" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
         <div class="row">
           <div class="input-field col s12">
             <input id="username" name="username" type="text" class="validate" placeholder="Username" required>
             <input id="password" name="password" type="password" class="validate" placeholder="Password" required>
             <button type="submit" class="full-btn btn-large waves-effect waves- deep-purple darken-4" name="login" value="login">Login</button>
             <br><br>
             <a href="https://smashsdgs.me/register.php" class="full-btn btn-large black-text waves-effect waves- white">I don't have an account</a>
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
