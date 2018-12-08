<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tinder</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<header>
    <nav>
        <a href="#">
            <img src="img/canes.png" alt="logo">
        </a>
        <ul>
            <li><a href="index.php">Home</li>
            <li><a href="select.php">Sql select</li>
        </ul>
        <div>
            <form action="includes/login.inc.php" method="post">
                <input type="text" name="uname" placeholder="Username">
                <input type="password" name="pwd" placeholder="Password">
                <button type="submit" name="login-submit">Login</button>
            </form>
            <a href="signup.php">Signup</a>
            <form action="includes/logout.inc.php" method="post">
                <button type="submit" name="logout-submit">Logout</button>
            </form>
        </div>
    </nav>
</header>
