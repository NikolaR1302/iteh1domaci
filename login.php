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
    <title>Movies to watch</title>

</head>
<body>
    <div class="login-form">
        <div class="main-div">
            <form method="GET" action="#"> 
                <h1>Movies to watch</h1>
                <div class="container">
                    <input type="text" placeholder="username" name="username" class="login-input"  required>
                    <input type="password" placeholder="password" name="password" class="login-input" required>
                    <button type="submit" class="login-button" name="submit">Log in</button> 
                </div>

            </form>
        </div>
    </div>
</body>
</html>