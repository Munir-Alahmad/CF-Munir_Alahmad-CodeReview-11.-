<?php
    session_start();

    if(isset($_SESSION["user"])){
        header("Location: ../home.php");
    }

    if(!isset($_SESSION["chef"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["user"])){
        header("Location: ../login.php");
    }

    require_once "../components/db_connect.php";

    if(isset($_GET["id"])){
        $id = $_GET["id"];

        $spl = "SELECT * FROM animal WHERE id = $id";
        $result = mysqli_query($connect , $spl);
        $row = mysqli_fetch_assoc($result);
    }
?>
<!DOCTYPE html>
<html lang="en" >
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content ="width=device-width, initial-scale=1.0">
       <?php require_once '../components/boots.php'?>
       <style><?php include "css/update.css"; ?></style>
       <title>Add Animal</title>
    
   </head>
   <body>
       <fieldset>
           <legend class='h2'> Update details</legend>
           <form action="actions/a_update.php"  method= "post" enctype= "multipart/form-data">
               <table  class='table'>
               <tr>
                       <th>Name</th>
                        <td><input value="<?php echo $row["name"] ?>" class ='form-control' type="text"  name="name"  placeholder ="Animal Name" /></td>
                   </tr>
                   <tr>
                       <th>picture</th >
                       <td><input  class= 'form-control' type="file"  name="picture" ></td>
                   </tr>
                   <tr>
                       <th>Description</th>
                        <td><input value="<?php echo $row["description"] ?>" class ='form-control' type="text"  name="description"  placeholder ="Enter Animal description"/></td>
                   </tr>

                   <tr>
                       <th>Type</th>
                        <td><input value="<?php echo $row["type"] ?>" class ='form-control' type="text"  name="type"  placeholder ="Enter Animal type" /></td>
                   </tr>

                   <tr>
                       <th>age</th>
                        <td><input value="<?php echo $row["age"] ?>" class ='form-control' type="number"  name="age"  placeholder ="Enter Animal age" /></td>
                   </tr>

                   <tr>
                       <th>sexuality</th>
                        <td>
                            <select value="<?php echo $row["sexuality"] ?>" class ='form-control'  name="sexuality">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </td>
                   </tr>

                   <tr>
                       <th>Location</th>
                        <td><input value="<?php echo $row["location"] ?>"  class ='form-control' type="text"  name="location"  placeholder ="Enter location" /></td>
                   </tr>

                   <tr>
                       <th>hobbies</th>
                        <td><input value="<?php echo $row["hobbies"] ?>"  class ='form-control' type="text"  name="hobbies"  placeholder ="Enter Animal hobbies" /></td>
                   </tr>
         
                   <tr>
                       <input class= 'form-control' type="hidden"  name="id" value="<?php echo $row["id"] ?>"/>
                       <input class= 'form-control' type="hidden"  name="picture" value="<?php echo $row["picture"] ?>"/>
                       <td><button class ='btn btn-success' type= "submit">Update Product</button></td>
                       <td><a class= 'btn btn-warning' href="index.php" >Home</a><td>
                   </tr>
               </table>
           </form>
       </fieldset>
   </body>
</html>