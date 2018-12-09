<?php 
/*

$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "tinder";

$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection to sql failed: ".mysqli_connect_error());
}

*/

class SQLconnection
{
    function ConnectSQL() {
        $config = "mysql:host=localhost;dbname=st2014";
        $username="st2014";
        $password="progress";

        return new PDO($config, $username, $password);
    }
}