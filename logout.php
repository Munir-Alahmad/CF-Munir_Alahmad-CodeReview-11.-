<?php
session_start();
if(!isset($_SESSION["chef"]) && !isset($_SESSION["adm"]) && !isset($_SESSION["user"])){
   header("Location: ../login.php");
    exit;
}
elseif(isset ($_SESSION[ 'user'])!="") {
   header("Location: home.php");
}
elseif(isset($_SESSION[ 'adm'])!= "") {
   header("Location: products/index_adm.php");
}
elseif(isset ($_SESSION[ 'chef'])!="") {
   header("Location: dashboard.php");
}

if( isset($_GET['logout'])) {
unset($_SESSION['user'  ]);
unset($_SESSION['adm' ]);
unset($_SESSION['chef' ]);
session_unset();
session_destroy();
header("Location: login.php");
exit;
}