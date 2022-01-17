<?php
 require "dbBroker.php";
 require "user.php";

 session_start();

 if(isset($_GET['username']) && isset($_GET['password'])) {
     $username=$_GET['username'];
     $password=$_GET['password'];

    $rs = User::logInUser($username, $password, $connection);


      if($rs->num_rows==1) {
          echo "Uspešno logovanje";
          $_SESSION['user_id'] = $rs->fetch_assoc()['id'];
          header('Location: home.php');
          exit();
      } else {
      
          echo '<script type="text/javascript">alert("Try again :("); 
                                                window.location.href = "http://localhost/iteh/itehDomaci1/login.php";</script>';
          exit();
      }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Movies to watch</title>

</head>
<body>
        <div class="login-box">
        <form method="GET" action="#"> 
        <h2>Login</h2>
        <form>
            <div class="user-box">
            <input type="text" name="username" required>
            <label>Username</label>
            </div>
            <div class="user-box">
            <input type="password" name="password" required>
            <label>Password</label>
            </div>
            <a href="#">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <button type="submit" class="login-button" name="submit">Log in</button> 
            </a>
        </form>
        </form>
        </div>

    
</body>
</html>