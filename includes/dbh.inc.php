<?php 

$dbServerName = "dijkstra.cs.ttu.ee";
$dbUsername = "st2014";
$dbPassword = "progress";
$dbName = "st2014";

/*

$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "tinder";

*/

$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection to sql failed: ".mysqli_connect_error());
}