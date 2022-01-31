<?php
 require_once "components/db_connect.php";
 $text =  $_GET["text"];
 $sql = "SELECT * from animal WHERE name LIKE '$text%'";
 $result = mysqli_query($connect, $sql);
 if($result->num_rows == 0){
     echo "No Results";
 }else {
     $rows = $result->fetch_all(MYSQLI_ASSOC);
 foreach($rows as $value){
     echo $value["name"]. "<hr>";
 }
 }