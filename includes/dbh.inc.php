<?php

$dbServerName = "localhost";
$dbUsername = "st2014";
$dbPassword = "progress";
$dbName = "st2014";

$usersTable = "t155233_users";

$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection to sql failed: ".mysqli_connect_error());
}

/*

$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "tinder";

$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection to sql failed: ".mysqli_connect_error());
}

----------- Above line LOCAL and below SERVER cnnxion ---------------

class SQLconnection
{
    function ConnectSQL() {
        $config = "mysql:host=localhost;dbname=st2014";
        $username="st2014";
        $password="progress";

        return new PDO($config, $username, $password);
    }
}
*/

