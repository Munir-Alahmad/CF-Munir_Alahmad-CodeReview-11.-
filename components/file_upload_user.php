<?php
function file_upload($userpic)
{
   $result = new stdClass();
   if(isset($_SESSION["chef"])){
    $result->fileName = 'admavatar.png';
   }else if(isset($_SESSION["adm"])){
    $result->fileName = 'avatar.png';
   }else if(isset($_SESSION["user"])){
    $result->fileName = 'avatar.png';
    }else{
    $result->fileName = 'avatar.png';
   }
     
   
   $result->error = 1;
   $fileName = $userpic["name"];
   $fileTmpName = $userpic["tmp_name"];
   $fileError = $userpic["error"];
   $fileSize = $userpic["size"];
   $fileExtension = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));    
   $filesAllowed = ["png", "jpg", "jpeg"];
   if ($fileError == 4) {      
       $result->ErrorMessage = "No userpic was chosen. It can always be updated later.";
       return $result;
   } else {
       if (in_array($fileExtension, $filesAllowed)) {
           if ($fileError === 0) {
               if ($fileSize < 1000000) { 
                   $fileNewName = uniqid('') . "." . $fileExtension;

                   if(isset($_SESSION["chef"])){
                    $destination = "pictuers/$fileNewName";
                   }else if(isset($_SESSION["adm"])){
                    $destination = "pictuers/$fileNewName";
                   }else if(isset($_SESSION["user"])){
                    $destination = "pictuers/$fileNewName";
                   }else{
                    $destination = "pictuers/$fileNewName";
                   }

                   if (move_uploaded_file($fileTmpName, $destination)) {
                       $result->error = 0;
                       $result->fileName = $fileNewName;
                       return $result;
                   } else {    
                       $result->ErrorMessage = "There was an error uploading this file.";
                       return $result;
                   }
               } else {                                      
                   $result->ErrorMessage = "This userpic is bigger than the allowed 500Kb. <br> Please choose a smaller one and Update your profile.";
                   return $result;
               }
           } else {                              
               $result->ErrorMessage = "There was an error uploading - $fileError code. Check php documentation.";
               return $result;
           }
       } else {                      
           $result->ErrorMessage = "This file type cant be uploaded.";
           return $result;
       }
   }
}