<?php
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
       <style><?php include "css/details.css"; ?></style>
       <title>Details</title>
    
   </head>
   <body>
       <div class="prodet">
            <fieldset>
                <legend class='h2'> Animal details  <a class= 'btn btn-warning' href="index.php" >Go to Home</a></legend>
                    <table  class='table'>
                        <tr>
                            <th>Name</th>
                            <td> <?= $row["name"] ?> </td>
                        </tr>
                        <tr>
                            <th>description</th>
                            <td>"<?= $row["description"] ?></td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td>"<?= $row["type"] ?></td>
                        </tr>
                        <tr>
                            <th>age</th>
                            <td><?= $row["age"] ?> </td>
                        </tr>
                        <tr>
                            <th>sexuality</th>
                            <td><?= $row["sexuality"] ?></td>
                        </tr>
                        <tr>
                            <th>location</th>
                            <td><?= $row["location"] ?></td>
                        </tr>

                        <tr>
                            <th>hobbies</th>
                            <td><?= $row["hobbies"] ?></td>
                        </tr>

                    
                    </table>
            </fieldset>
            <div class="foto">
             <img src='../pictuers/<?= $row["picture"] ?>' width='450'  height='450'>
            </div>
       </div>
   </body>
</html>

