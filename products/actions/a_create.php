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

    if($_POST){
        $name = $_POST["name"];
        $picture =file_upload($_FILES["picture"]);
        $description = $_POST["description"];
        $type = $_POST["type"];
        $age = $_POST["age"];
        $sexuality = $_POST["sexuality"];
        $location = $_POST["location"];
        $hobbies = $_POST["hobbies"];
        $uploadError = "";
       

        $ErrorMsg = "";

        $sql = "INSERT INTO animal (name, picture, description, type, age, sexuality, location, hobbies) VALUES ('$name', '$picture->fileName', '$description', '$type', '$age', '$sexuality', '$location', '$hobbies')";
        if(mysqli_query($connect, $sql)){
            $class ="success";
            $message = "The entry below was successfully created <br>
                <p> $name <br> $description <br>$type <br>$age <br> <hr> $sexuality  <br> $location <br> <hr> $hobbies <br> <hr>  </p>";
            $uploadError = ($picture->error !=0)? $picture->ErrorMessage : '';
        }else{
            $class = "danger";
            $message = "error while creating record. Try again: <br>" . $connect->error;
            $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
        } 
        $connect->close();
    }else{
        header("location: ../error.php");
    }
?>



<!DOCTYPE html>
<html lang= "en">
   <head>
       <meta  charset="UTF-8">
       <title>Update</title>
       <?php require_once '../../components/boots.php' ?>
   </head>
   <body>
       <div  class="container">
           <div class="mt-3 mb-3" >
               <h1>Create request response</h1>
           </div>
            <div class="alert alert-<?=$class;?>" role="alert">
               <p><?php echo ($message) ?? ''; ?></p>
                <p><?php echo ($uploadError) ?? ''; ?></p>
                <a href='../index.php'><button class="btn btn-primary"  type='button'>Home</button ></a>
           </div >
       </div>
   </body>
</html>