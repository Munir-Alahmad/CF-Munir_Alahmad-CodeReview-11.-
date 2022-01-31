<?php 
session_start();
require_once "../../components/db_connect.php";
if(isset($_SESSION["user"])){
    header("Location: ../home.php");
}

if(!isset($_SESSION["chef"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["user"])){
    header("Location: ../login.php");
}
  require_once "../../components/file_upload.php";

if  ($_POST) {
   $id = $_POST[ 'id'];
   $picture = $_POST['picture'];
   ($picture =="product.png")?: unlink("../../pictuers/$picture");

   $sql = "DELETE FROM animal WHERE id = {$id}";
   if (mysqli_query($connect, $sql) === TRUE) {
       $class = "success";
       $message = "Successfully Deleted!";
   } else {
       $class = "danger";
       $message = "The entry was not deleted due to: <br>" . $connect->error;
   }
   $connect->close();
} else {
   header("location: ../error.php");
}
?>


<!DOCTYPE html>
<html lang= "en">
   <head>
       <meta  charset="UTF-8">
       <title>Delete</title>
       <?php require_once '../../components/boots.php' ?> 
   </head>
   <body>
       <div  class="container">
           <div class="mt-3 mb-3" >
               <h1>Delete request response</h1>
           </div>
            <div class="alert alert-<?=$class;?>" role="alert">
               <p><?=$message;?></p >
               <a href ='../index.php'><button class= "btn btn-success" type='button'> Home</button></a>
            </div>
       </div >
   </body>
</html>