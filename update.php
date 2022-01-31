<?php
session_start();
require_once 'components/db_connect.php';
require_once 'components/file_upload_user.php';
// if session is not set this will redirect to login page
if(!isset($_SESSION['chef']) && !isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
   header("Location: index.php");
   exit;
  }

 
$backBtn = '';
//if it is a user it will create a back button to home.php
if (isset($_SESSION["user"])){
   $backBtn = "home.php";    
}
//if it is a adm it will create a back button to dashboard.php
if(isset($_SESSION["adm"])){
   $backBtn = "products/index_adm.php";    
}

if(isset($_SESSION["chef"])){
    $backBtn = "dashBoard.php";    
 }

//$res2 = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['user']);
//$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
//$row2 = mysqli_fetch_assoc($res2);
//fetch and populate form
if (isset($_GET[ 'id'])) {
   $id = $_GET['id'];
   $sql = "SELECT * FROM user WHERE id = {$id}";
   $result = mysqli_query($connect , $sql);
   if (mysqli_num_rows($result) == 1) {
       $data = mysqli_fetch_assoc($result);
       $first_name = $data['first_name'];
       $last_name = $data['last_name'];// ohna variable $first_name auch geht es
       $email = $data['email'];
       $date_birth = $data['date_of_birth'];
       $userpic = $data['userpic'];
   }  
}

//update
$class = 'd-none';
if (isset($_POST["submit" ])) {
   $first_name = $_POST['first_name'];
   $last_name = $_POST['last_name' ];
   $email = $_POST[ 'email'];
   $date_of_birth = $_POST['date_of_birth'];
   $id = $_POST['id'];
    //variable for upload pictures errors is initialized
   $uploadError = '';    
   $userpicArray = file_upload($_FILES['userpic']); //file_upload() called
   $userpic = $userpicArray->fileName;
   if ($userpicArray->error === 0) {      
       ($_POST[ "userpic"] == "admavatar.png") ?: unlink("pictuers/{$_POST["userpic"]}");
       $sql = "UPDATE user SET first_name = '$first_name', last_name = '$last_name', email = '$email', date_of_birth = '$date_of_birth', userpic = '$userpicArray->fileName' WHERE id = {$id}";
   } else {
       $sql = "UPDATE user SET first_name = '$first_name', last_name = '$last_name', email = '$email', date_of_birth = '$date_of_birth' WHERE id = {$id}";
   }
    if (mysqli_query($connect , $sql)) {    
       $class = "alert alert-success";
       $message = "The record was successfully updated";
       $uploadError = ($userpicArray->error != 0) ? $userpicArray->ErrorMessage : '';
       header("refresh:3;url=update.php?id={$id}");
   } else {
       $class = "alert alert-danger";
       $message = "Error while updating record : <br>" . $connect->error;
       $uploadError = ($userpicArray->error != 0) ? $userpicArray->ErrorMessage : '';
       header("refresh:3;url=update.php?id={$id}");
   }
}


$connect->close();
?>


<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport"   content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <?php require_once 'components/boots.php'?>
    <style><?php include "products/css/userupdate.css"; ?></style>
  
</head>
<body>
<!-- navbar start -->
<!-- <div class ="container1">
    <div class="hero">
        <img class= "userImage" src="pictuers/<?php echo $row['userpic']; ?>" alt="<?php echo $row['first_name']; ?>">
        <p class ="text-white" >Hallo <?php  echo $row2['first_name'];?></p>
        <div class="butt">
        <a class="button-8" href="home_senior.php">Senior </a>
        <a class="button-8" href="home.php">All Animal </a>
        <a class="button-8" href="logout.php?logout"> Sign Out</a>
        <a class="button-8" href="update.php?id=<?php echo $_SESSION['user'] ?>">Update your profile</a>
        </div>
    </div>
</div> -->
<!-- navbar end -->


<div class ="container">
   <div class="<?php echo $class; ?>"  role="alert">
       <p><?php echo ($message) ?? ''; ?></p>
        <p><?php echo ($uploadError) ?? ''; ?></p>       
    </div>
   
    <h1>Update your profil</h1> 
    <div class="fotoform">
        <img class='img-thumbnail rounded-circle'  src='pictuers/<?php echo $data['userpic'] ?>' alt="<?php echo $first_name ?>">
        <form  method="post" enctype="multipart/form-data">
            <table  class="table">
                <tr>
                    <th>First Name</th >
                    <td><input class="form-control"  type="text"  name ="first_name" placeholder = "First Name"  value="<?php echo $first_name ?>"/>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td ><input class= "form-control" type= "text"  name="last_name"  placeholder="Last Name" value ="<?php echo $last_name ?>"/>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input class ="form-control" type ="email" name ="email" placeholder = "Email" value = "<?php echo $email ?>"/>
                </tr>
                <tr>
                    <th>Date of birth</th>
                        <td ><input class= "form-control" type ="date"  name="date_of_birth"  placeholder= "Date of birth"   value = "<?php echo $date_birth ?>"/>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input  class= "form-control"  type ="file"   name = "userpic" /></td>
                </tr >
                <tr>
                    <input type = "hidden"   name = "id"   value = "<?php echo $data['id'] ?>" />
                    <input type = "hidden"   name = "userpic"   value = "<?php echo $userpic ?>" />
                    <td><button  name = "submit"  class = "btn btn-success"   type = "submit" > Save Changes </button>
                    <td><a href = "<?php echo $backBtn?>" ><button class = "btn btn-warning"   type = "button"> Back </button></a>
                </tr>
            </table>
        </form> 
    </div>      
          
</div>
</body>
</html>