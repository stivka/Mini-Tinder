<?php 

/* if statement to prevent access directly for url,
so as the button submit has been clicked */

if(isset($_POST['signup-submit'])) {

    require 'dbh.inc.php';
    
    include_once 'dbh.inc.php';

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $pwdRepeat = mysqli_real_escape_string($conn, $_POST['pwd-repeat']);

    //Error handlers
    //Check for empty fields
    if (empty($email) ||  empty($uname) ||empty($firstname) || empty($surname) || empty($pwd) || empty($pwdRepeat)) {
        header("Location: ../signup.php?error=emptyfields&uname=".$uname."&email=".$email);
        exit();
    }
    //Doesn't contain anything else but a-zA-Z
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $uname)) {
        header("Location: ../signup.php?error=invalidmail&uname");
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&uname=".$uname);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $uname)) {
        header("Location: ../signup.php?error=invaliduname&mail=".$email);
        exit();
    }
    else if ($pwd !== $pwdRepeat) {
        header("Location: ../signup.php?error=passwordcheck&uname=".$uname."&email=".$email);
        exit();
    }
    /*username is already taken, this needs cnnxion to database
    and prepared statement to be safe
    */
    else {
        $sql = "SELECT uname FROM users WHERE uname=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=mysql_error");
            exit();
        }
        else {
            //s stands for the datatype string that is used
            mysqli_stmt_bind_param($stmt, "s", $uname);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            //resultCheck should be 1 or 0.
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=usertaken&email=".$email);
                exit();
            }
            else {

                $sql = "INSERT INTO users (email, uname, firstname, surname, pwd) VALUES (?, ?, ?, ?, ?)";

                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sql_insert_error");
                    exit();
                }
                else {
                /* params email uname etc. should be int the same order as they are
                in the insert statement.
                Also i'm sending the hashed password, hashed with bcrypt.
                */
                $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($stmt, "sssss", $email, $uname, $firstname, $surname, $hashedPwd);
                mysqli_stmt_execute($stmt);
                header("Location: ../signup.php?signup=success");
                exit();
                }
            }
        }
    }
    //closing the sql, to save resources
    mysqli_stmt_close();
    mysqli_close($conn);
}
else {
    header("Location: ../signup.php");
    exit();
}