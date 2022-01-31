<?php 

$localhost = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "cr11_muniralahmad_petadoption";

// create connection
$connect = new  mysqli($localhost, $username, $password, $dbname);
//mysqli_connect
// check connection
if($connect->connect_error) {
   die ("Connection failed: " . $connect->connect_error);
}