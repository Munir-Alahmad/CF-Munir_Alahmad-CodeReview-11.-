<?php
    session_start();

    require_once "../components/db_connect.php";

    if(isset($_SESSION["user"])){
        header("Location: ../home.php");
    }

    if(!isset($_SESSION["chef"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["user"])){
        header("Location: ../login.php");
    }

    // $sql = "SELECT * FROM animal";
    // $result = mysqli_query($connect, $sql);
    // $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>




<!DOCTYPE html>
<html lang="en" >
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content ="width=device-width, initial-scale=1.0">
       <?php require_once '../components/boots.php'?>
       <style><?php include "css/create.css"; ?></style>
       <title>Add Product</title>
      
   </head>
   <body>
       <div class="stor">
           <p>ANIMALSTORE</p>
       </div>
       
       <fieldset>
           <legend class='h2'> Add new Animal</legend>
           <form action="actions/a_create.php"  method= "post" enctype= "multipart/form-data">
               <table  class='table'>
                   <tr>
                       <th>Name</th>
                        <td><input  class ='form-control' type="text"  name="name"  placeholder ="Animal Name" /></td>
                   </tr>

                   <tr>
                       <th>picture</th >
                       <td><input class= 'form-control' type="file"  name="picture" /></td>
                   </tr>

                   <tr>
                       <th>Description</th>
                        <td><input  class ='form-control' type="text"  name="description"  placeholder ="Enter Animal description" /></td>
                   </tr>

                   <tr>
                       <th>Type</th>
                        <td><input  class ='form-control' type="text"  name="type"  placeholder ="Enter Animal type" /></td>
                   </tr>

                   <tr>
                       <th>age</th>
                        <td><input  class ='form-control' type="number"  name="age"  placeholder ="Enter Animal age" /></td>
                   </tr>

                   <tr>
                       <th>sexuality</th>
                        <td>
                            <select class ='form-control'  name="sexuality">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </td>
                   </tr>

                   <tr>
                       <th>Location</th>
                        <td><input  class ='form-control' type="text"  name="location"  placeholder ="Enter location" /></td>
                   </tr>

                   <tr>
                       <th>hobbies</th>
                        <td><input  class ='form-control' type="text"  name="hobbies"  placeholder ="Enter Animal hobbies" /></td>
                   </tr>

                
                   <tr>
                       <td><button class ='btn btn-success' type= "submit">Insert Product</button></td>
                       <td><a href="index.php" ><button class= 'btn btn-warning' type= "button">Home</button></a><td>
                   </tr>
               </table>
           </form>
       </fieldset>
   </body>
</html>


