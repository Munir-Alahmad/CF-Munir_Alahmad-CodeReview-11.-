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
        $name = $_POST['name'];
        $picture =file_upload($_FILES['picture']);
        $description = $_POST['description'];
        $type = $_POST['type'];
        $age = $_POST['age'];
        $sexuality = $_POST['sexuality'];
        $location = $_POST['location'];
        $hobbies = $_POST['hobbies'];
        $id = $_POST['id'];    
        $uploadError = '';
 
    $picture = file_upload($_FILES['picture']);//file_upload() called  
    if ($picture->error===0){
        ($_POST["picture"]=="product.png")?: unlink("../../pictuers/$_POST[picture]");          
        $sql = "UPDATE animal SET  name = '$name', picture = '$picture->fileName', description ='$description' ,type = '$type', age = '$age', sexuality = '$sexuality' ,location ='$location', hobbies ='$hobbies'  WHERE id = {$id}";
    }else{
        $sql = "UPDATE animal SET name = '$name', description = '$description', type = '$type', age = '$age', sexuality = '$sexuality', location = '$location', hobbies ='$hobbies'  WHERE id = {$id}";
    }    
    if ($connect->query($sql) === TRUE) {
        $class = "success";
        $message = "The record was successfully updated";
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . $connect->error;
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
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
       <title>Update</title>
       <?php require_once '../../components/boots.php' ?> 
   </head>
   <body>
       <div  class="container">
           <div class="mt-3 mb-3" >
               <h1>Update request response</h1>
           </div>
            <div class="alert alert-<?php echo $class;?>" role="alert">
               <p><?php echo ($message) ?? ''; ?></p>
                <p><?php echo ($uploadError) ?? ''; ?></p>
                <a href='../update.php?id=<?=$id;?>' ><button class="btn btn-warning" type='button'>Back</button></a>
                <a href='../index.php'><button class="btn btn-success"  type='button'>Home</button></a>
            </div>
       </div>
   </body>
</html>