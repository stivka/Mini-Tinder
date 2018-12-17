<?php
session_start();
$uid = $_SESSION['userId'];
echo '<pre>' . var_dump($_SESSION) . '</pre>';
echo '<pre>' . var_dump($_POST) . '</pre>';

if (isset($_POST["dislike-submit"])) {
    $ratedPersonId = findUserIdOfPersonInPicture($_POST["dislike-submit"]);
    insertIntoRated($ratedPersonId);
}

else if (isset($_POST["like-submit"])) {
    $ratedPersonId = findUserIdOfPersonInPicture($_POST["like-submit"]);
    insertIntoRated($ratedPersonId);
    insertIntoLikes($ratedPersonId);
} else {
    echo "Sorry, there was an error rating the picture.";
}

function findUserIdOfPersonInPicture($filename) {
    require "dbh.inc.php";
    echo 'variable filename is: ' . $filename . '<br>';

    $sql = "SELECT id FROM t155233_users WHERE photo_filename = '$filename'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id of the rated person is: " . $row["id"]. "<br>";
            $ratedPersonId = $row["id"];
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $ratedPersonId;
}
    
function insertIntoLikes($ratedPersonId) {
    require "dbh.inc.php";
    $uid = $_SESSION['userId'];

    $sql = "INSERT INTO t155233_likes (uid, likes) VALUES ($uid, $ratedPersonId);";

    if ($conn->query($sql) === TRUE) {
        // echo "New record created successfully";
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function insertIntoRated($ratedPersonId) {
    require "dbh.inc.php";
    $uid = $_SESSION['userId'];

    //echo 'inside insert function ' . $ratedPersonId;

    $sql = "INSERT INTO t155233_rated (uid, rated) VALUES ($uid, $ratedPersonId);";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

header('Location: ../index.php');