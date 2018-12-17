<?php

// session is started in login
require "dbh.inc.php";

if (isset($_POST["dislike-submit"])) {
    
    $id_of_rated = $_POST["dislike-submit"];

    echo $id_of_rated;

    session_start();
    //echo '<pre>' . var_dump($_SESSION) . '</pre>';
    $uid = $_SESSION['userId'];
    
    $sql = "INSERT INTO t155233_rated (uid, rated) VALUES ($uid, $id_of_rated)";

    if ($conn->query($sql) === TRUE) {            
        echo "Record updated successfully";
    } else {
         echo "Error updating record: " . $conn->error;
    }    
    $conn->close();
} else {
    echo "Sorry, there was an error setting your dislike.";
}

if (isset($_POST["like-submit"])) {
    
    $id_of_rated = $_POST["like-submit"];

    echo $id_of_rated;

    session_start();
    //echo '<pre>' . var_dump($_SESSION) . '</pre>';
    $uid = $_SESSION['userId'];
    
    $sql = "INSERT INTO t155233_likes (uid, likes) VALUES ($uid, $id_of_rated)";

    if ($conn->query($sql) === TRUE) {            
        echo "Record updated successfully";
    } else {
         echo "Error updating record: " . $conn->error;
    }    
    $conn->close();
} else {
    echo "Sorry, there was an error setting your like.";
}