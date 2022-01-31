<?php
session_start();
require_once 'components/db_connect.php';
if (isset($_SESSION['adm' ])) {
   header("Location: products/index_adm.php");
   exit;
}
if (isset($_SESSION['chef' ])) {
   header("Location: dashboard.php");
   exit;
}
if(!isset($_SESSION['chef']) && !isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
   header("Location: login.php" );
    exit;
}
$res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['user']);
//$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
$row = mysqli_fetch_assoc($res);





$sql2 = "SELECT * FROM animal WHERE age >= 8 ";
$result2 = mysqli_query($connect, $sql2);
$bage2 ="";

if(mysqli_num_rows($result2) > 0){
while($row2 = mysqli_fetch_assoc($result2)){
    $bage2 .= "
    <div class='card mb-3' style='max-width: 400px;'>
        <div class='row g-0'>
            <div class='col-md-5'>
                <img src='../pictuers/{$row2['picture']}' class='card-img-top' alt='...' height='250' >
            </div>
            <div class='col-md-7'>
                <div class='card-body'>
                    <h4 class='card-title'>Name: {$row2['name']}</h4>
                    <p class='card-text'>Type: {$row2['type']}</p>
                    <p class='card-text'>age: {$row2['age']}</p>
                    <p class='card-text'>sexuality: {$row2['sexuality']}</p>
                    <p class='card-text'>location: {$row2['location']}</p>
                    <a href='update.php?id={$row2['id']}' class='button-8' role='button' >Update</a>
                    <a href='delete.php?id={$row2['id']}' class='button-8' role='button' >Delete</a>
                    <a href='details.php?id={$row2['id']}' class='button-8' role='button'>Details</a>
                    
                </div>
            </div>
        </div>
    </div>";
}


}else{
    $bage2 = "No results";
}

?>





<!DOCTYPE html>
<html lang="en" >
<head>
   <meta charset="UTF-8">
    <meta name="viewport"   content="width=device-width, initial-scale=1.0">
<title>Welcome - <?php  echo $row['first_name']; ?></title >
<?php require_once 'components/boots.php' ?>
<style><?php include "products/css/home.css"; ?></style>
<style>

</style>
</head>
<body>
   <div class ="container1">
      <div class="hero">
         <img class= "userImage" src="pictuers/<?php echo $row['userpic']; ?>" alt="<?php echo $row['first_name']; ?>">
         <p class ="text-white" >Hallo <?php  echo $row['first_name'];?></p>
         <div class="butt">
            <a class="button-8" href="home_senior.php">Senior </a>
            <a class="button-8" href="home.php">All Animal </a>
            <a class="button-8" href="logout.php?logout"> Sign Out</a>
            <a class="button-8" href="update.php?id=<?php echo $_SESSION['user'] ?>">Update your profile</a>
         </div>
      </div>
      <!-- 
         <a class="button-8" href="logout.php?logout"> Sign Out</a>
         <a class="button-8" href="update.php?id=<?php echo $_SESSION['user'] ?>">Update your profile</a>
       -->
   </div>

   <div class="container"> 
        <div class="row">
            <?php echo $bage2 ?>
        </div>
    </div>

</body>
</html>