<?php
session_start(); // start a new session or continues the previous

if (isset($_SESSION[ 'user']) != "") {
    header("Location: home.php");
exit;
}

if (isset($_SESSION[ 'adm']) != "") {
    header("Location: products/index_adm.php");
exit;
}
if (isset($_SESSION['chef' ]) != "") {
    header("Location: dashboard.php"); // redirects to home.php
}

require_once  'components/db_connect.php';
require_once 'components/file_upload_user.php';
$error = false;
$first_name = $last_name = $email = $date_of_birth = $password = $userpic = '';
$first_nameError = $last_nameError = $emailError = $dateError = $passwordError = $picError = '';
if (isset($_POST[ 'btn-signup'])) {

   // sanitize user input to prevent sql injection
   $first_name = trim($_POST['first_name']);

    //trim - strips whitespace (or other characters) from the beginning and end of a string
   $first_name = strip_tags($first_name);

   // strip_tags -- strips HTML and PHP tags from a string

   $first_name = htmlspecialchars($first_name);
   // htmlspecialchars converts special characters to HTML entities
   
   $last_name = trim($_POST['last_name']);
   $last_name = strip_tags($last_name);
   $last_name = htmlspecialchars($last_name);    

   $email = trim($_POST['email']);
   $email = strip_tags($email);
   $email = htmlspecialchars($email);

   $date_of_birth = trim($_POST['date_of_birth']);
   $date_of_birth = strip_tags($date_of_birth);
   $date_of_birth = htmlspecialchars($date_of_birth);

   $pass = trim($_POST['pass']);
   $pass = strip_tags($pass);
   $pass = htmlspecialchars($pass);

   $uploadError = '';
   $userpic = file_upload($_FILES['userpic']);

   // basic name validation
   if (empty($first_name) || empty($last_name)) {
       $error = true;
       $first_nameError = "Please enter your full name and surname";
   } else if (strlen($first_name) < 3  || strlen($last_name) < 3) {
       $error = true;
       $first_nameError = "Name and surname must have at least 3 characters.";
   } else if (!preg_match("/^[a-zA-Z]+$/", $first_name) || !preg_match("/^[a-zA-Z]+$/", $last_name)) {
       $error = true;
       $first_nameError = "Name and surname must contain only letters and no spaces.";
   }
 
   //basic email validation
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $error = true;
       $emailError = "Please enter valid email address.";
   } else {
   // checks whether the email exists or not
       $query = "SELECT email FROM user WHERE email='$email'";
       $result = mysqli_query($connect, $query);
       $count = mysqli_num_rows($result);
       if ($count != 0) {
           $error = true;
           $emailError = "Provided Email is already in use.";
       }
   }
   //checks if the date input was left empty
   if (empty($date_of_birth)) {
       $error = true;
       $dateError = "Please enter your date of birth.";
   }
   // password validation
   if (empty($pass)) {
       $error = true;
       $passError = "Please enter password.";
   } else if (strlen($pass) < 6 ) {
       $error = true;
       $passError = "Password must have at least 6 characters." ;
   }

   // password hashing for security
   $password = hash('sha256', $pass);
   // if there's no error, continue to signup
    if (!$error) {

       $query = "INSERT INTO user(first_name, last_name, password, date_of_birth, email, userpic)
                 VALUES('$first_name', '$last_name', '$password', '$date_of_birth', '$email', '$userpic->fileName')";
       $res = mysqli_query($connect, $query);

       if ($res) {
           $errTyp = "success";
           $errMSG = "Successfully registered, you may login now";
           $uploadError = ($userpic->error != 0) ? $userpic->ErrorMessage : '';
           $first_name = $last_name = $email = $date_of_birth = $password = $userpic = '';

       } else {
           $errTyp = "danger";
           $errMSG = "Something went wrong, try again later..." ;
           $uploadError = ($userpic->error != 0) ? $userpic->ErrorMessage : '';
       }
   }
}


$connect->close();
// mysqli_close(connect);
?>
 

<!DOCTYPE html>
<html lang="en" >
<head>
   <meta charset="UTF-8">
    <meta name="viewport"   content="width=device-width, initial-scale=1.0">
<title>Login & Registration System </title>
<?php require_once  'components/boots.php'?>
<style><?php include "products/css/register.css"; ?></style>
</head>
<body>
<div class ="container">
  <form class="w-100"  method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off"  enctype="multipart/form-data">
            <h2>Sign Up.</h2>
            <hr/>
           <?php
           if (isset($errMSG)) {
           ?>
           <div class="alert alert-<?php echo $errTyp ?>"  >
                        <p><?php echo $errMSG; ?></p>
                        <p><?php echo $uploadError; ?></p>
           </div>

           <?php
           }
           ?>

           <input type ="text"  name="first_name"  class="form-control"   placeholder="First name" maxlength="50" value= "<?php echo $first_name ?>"   />
              <span class="text-danger" > <?php echo $first_nameError; ?> </span>

            <input type ="text"   name="last_name"  class ="form-control"  placeholder= "Surname" maxlength="50"  value="<?php echo $last_name ?>"  />
              <span class="text-danger" > <?php echo  $first_nameError; ?> </span >

           <input  type="email"  name="email" class ="form-control" placeholder ="Enter Your Email" maxlength="40" value = "<?php echo $email ?>"  />
              <span  class="text-danger" > <?php  echo $emailError; ?> </span>



            <input class='form-control w-100'  type="date"   name="date_of_birth"  value = "<?php echo $date_of_birth ?>"/>
                <span  class="text-danger" > <?php  echo $dateError; ?> </span>

            <input  class='form-control w-100' type="file" name= "userpic" >
                <span  class= "text-danger" >  <?php   echo  $picError; ?>   </span >


            <input   type = "password"   name = "pass"   class = "form-control"   placeholder = "Enter Password"   maxlength = "15"/>
              <span   class = "text-danger" >   <?php   echo  $passwordError; ?>   </span >
            
             
            <button   type = "submit"   class = "btn btn-block btn-primary" id="but2"  name = "btn-signup" > Sign Up </button> <hr/>
            <a class="lug" href="login.php">Sign in Here...</a>
             
           
            
  </form >
  </div >
</body >
</html >