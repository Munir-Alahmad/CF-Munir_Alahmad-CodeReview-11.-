<?php
    session_start();

    if(isset($_SESSION["user"])){
        header("Location: ../home.php");
    }

    if(isset($_SESSION["adm"])){
        header("Location:index_adm.php");
    }

    if(!isset($_SESSION["chef"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["user"])){
        header("Location: ../login.php");
    }


    require_once "../components/db_connect.php";
    //require_once "actions/db_connect.php";

    $sql = "SELECT * FROM animal";
    $result = mysqli_query($connect, $sql);
    $bage ="";

    if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $bage .= "
        <div class='card mb-3' style='max-width: 400px;'>
            <div class='row g-0'>
                <div class='col-md-5'>
                    <img src='../pictuers/{$row['picture']}' class='card-img-top' alt='...' height='250' >
                </div>
                <div class='col-md-7'>
                    <div class='card-body'>
                        <h4 class='card-title'>Name: {$row['name']}</h4>
                        <p class='card-text'>Type: {$row['type']}</p>
                        <p class='card-text'>age: {$row['age']}</p>
                        <p class='card-text'>sexuality: {$row['sexuality']}</p>
                        <p class='card-text'>location: {$row['location']}</p>
                        <a href='update.php?id={$row['id']}' class='button-8' role='button' >Update</a>
                        <a href='delete.php?id={$row['id']}' class='button-8' role='button' >Delete</a>
                        <a href='details.php?id={$row['id']}' class='button-8' role='button'>Details</a>
                        
                    </div>
                </div>
            </div>
        </div>";
    }
    




    }else{
        $bage = "No results";
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "../components/boots.php" ?>
  
    <style><?php include "css/index.css"; ?></style>
    <!-- <link rel="stylesheet" href="index.css"> -->
    <title>Document</title>
    
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg" style="background-color: #7FC9B6;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Munir Alahmad CR11</a>
 
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <a class="button-8 " href="create.php">Create product</a>
                    <a class="button-8"  href="../dashboard.php">Dashboard </a>
                    <a class="button-8" href="index_senior.php">Senior </a>
                    <a class="button-8" href="#">Manage products </a>
                    <a class="button-8" href="../logout.php?logout">Sign Out </a>
                </ul>
                
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
               
                </form>
            </div>
        </div>
    </nav>

    <!-- bootstrap card -->
    <div class="container"> 
        <div class="row">
            <?php echo $bage ?>
        </div>
    </div>
    
</body>
</html>