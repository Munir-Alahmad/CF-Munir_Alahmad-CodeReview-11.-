<?php
session_start();
require_once 'components/db_connect.php';
// if session is not set this will redirect to login page
if(!isset($_SESSION["chef"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["user"])){
    header("Location: ../login.php");
    exit;
}
//if session user exist it shouldn't access dashboard.php
if ( isset($_SESSION["user"])) {
   header("Location: home.php");
   exit;
}

$id = $_SESSION['chef' ];
$sql = "SELECT * FROM user WHERE status != 'chef' ";
$result = mysqli_query($connect , $sql);
//this variable will hold the body for the table
$tbody = '';
if (mysqli_num_rows($result) > 0) {
   while ($row = mysqli_fetch_assoc($result)) {
       $tbody .= "<tr>
           <td><img class='img-thumbnail rounded-circle' src='pictuers/" . $row['userpic'] . "' alt=" . $row['first_name'] . "></td>
           <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
           <td>" . $row['date_of_birth'] . "</td>
           <td>" . $row['email'] . "</td>
           <td><a href='update.php?id=" . $row['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
           <a href='delete.php?id=" . $row['id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
        </tr>";
   }
} else {
   $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}


$connect->close();
?>


<!DOCTYPE html>
<html lang="en" >
<head>
   <meta charset="UTF-8">
    <meta name="viewport"   content="width=device-width, initial-scale=1.0">
   <title>Chef-DashBoard</title>
   <?php require_once 'components/boots.php' ?>
   <style><?php include "products/css/dashboard.css"; ?></style>

</head>
<body>
<nav class="navbar navbar-expand-lg" style="background-color: #7FC9B6;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Munir Alahmad CR11</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <a class="button-8 " href="../products/create.php">Create product</a>
                    <a class="button-8"  href="dashboard.php">Dashboard </a>  
                    <a class="button-8" href="products/index_senior.php">Senior </a>
                    <a class="button-8" href="products/index.php">Manage products </a>
                    <a class="button-8" href="logout.php?logout">Sign Out </a>

                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">

                    <button class="btn btn-outline-success" type="submit">Search</button>

                    
                </form>
            </div>
        </div>
    </nav>

    <div class="container" >
        <div class= "row">
            <div  class="col-2">
                <p class=""> <h2>Administrator</h2>  </p>
                <img id='admfoto' class='img-thumbnail rounded-circle' class="userImage"  src="pictuers/admavatar.png"  alt= "Adm avatar">
            </div >
            <div  class="col-8 mt-2">
                <p class='h2' >Users</p>
                <table class='table table-striped'>
                    <thead  class='table-success'>
                        <tr>
                            <th>userpic</th>
                            <th>Name</th >
                            <th>Date of birth</th>
                            <th>Email</th>
                            <th>Action</th >
                        </tr>
                    </thead>
                    <tbody>
                        <?=$tbody?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>