<?php

if (isset($_POST['login-submit'])) {
    require "dbh.inc.php";
    
    $uname = $_POST['uname'];
    $pwd = $_POST['pwd'];

    if (empty($uname) || empty($pwd)) {
        header("Location: ../index.php?error=emptyfields");
    }
    else {
        // again to be secure, with placeholders and prepared statements
        $sql = "SELECT * FROM users WHERE uname=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sql_select_query");
            exit();
        }
        else {
            //adds values $uname and $pwd to $stmt
            mysqli_stmt_bind_param($stmt, "s", $uname);
            // executes the statement in the db
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            // assoc means putting it inside an associative array
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($pwd, $row['pwd']);
                if ($pwdCheck == false) {
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }
                else if ($pwdCheck == true) {
                    session_start();
                    $_SESSION['userId'] = $row['id'];
                    $_SESSION['uname'] = $row['uname'];

                    header("Location: ../index.php?login=success");
                    exit();
                }
                else {
                    header("Location: ../index.php?error=wrongpassword_isneitherfalseortrue");
                    exit();
                }
            } 
            else {
                header("Location: ../index.php?error=nouser");
            } 
        }
    }
} 
else {
    header("Location: ../index.php");
    exit();
}