 <?php

 if(!isset($_SESSION)) {
  session_start();

  if(!isset($_SESSION["message"])) {
    $_SESSION["message"] = "";
  }
 }

 include('includes/header.php');

 include('views/portfolio/index.php');
  
  include('includes/footer.php');
  
  ?>