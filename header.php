<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" type="image/png" href="img/canes.png"/>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <title>TinderCanes</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<header>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand " href="#">
            <img id="logo" src="img/canes.png" width="30" height="30" alt="TinderCanes logo">
        </a>
            <?php
if (isset($_SESSION['userId'])) {
    echo '      <p class="login-status">Merry Xmas ' . $_SESSION['uname'] . ' ;)</p>
                <form action="includes/logout.inc.php" method="post">
                    <button type="submit" name="logout-submit">Logout</button>
                </form>';
} else {
    echo '<form action="includes/login.inc.php" method="post">
                    <input type="text" name="uname" placeholder="Username">
                    <input type="password" name="pwd" placeholder="Password">
                    <button type="submit" name="login-submit">Login</button>
                </form>
                <a href="signup.php">Signup</a>';
}
            ?>

        </div>
</header>
