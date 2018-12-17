<?php

// session is started in login
require "dbh.inc.php";

if (isset($_POST["set_gender"])) {
    
    $gender = $_POST["gender"];

    session_start();
    //echo '<pre>' . var_dump($_SESSION) . '</pre>';
    $uid = $_SESSION['userId'];
    
    $sql = "UPDATE t155233_users SET gender='$gender' WHERE id='$uid'";

    if ($conn->query($sql) === TRUE) {            
        echo "Record updated successfully";
    } else {
         echo "Error updating record: " . $conn->error;
    }    
    $conn->close();
} else {
    echo "Sorry, there was an error setting your gender.";
}

echo '<br><a href="../index.php">Back to page</a>';