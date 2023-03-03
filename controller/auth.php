<?php

if(!isset($_SESSION)) 
  session_start();


include("../database/db.php");
include("../database/auth.php");

include("../helper/validation.php");

// Required, !Empty
if(isset($_POST["regform"])) {
  $message = "";
  $path = "/";
  $form_is_valid = checkForm($_POST, ["username", "email", "password", "password_confirm"]);

  if($form_is_valid) {
      $username = $_POST["username"];
      $email = $_POST["email"];
      $password = $_POST["password"];
      $password_confirm = $_POST["password_confirm"];

      
          $user = getUserByEmail($email);
          if(!$user) {
              if($password === $password_confirm) {

                  $user_id = create_user($username, $email, $password);
                  
                      $message = "Account is created successfully, please login";
                      $path = "/blogger/views/login.php";
               
              }
              else {
                  $message = "Password does not match the confirmation";
                  $path = "/blogger/views/register.php";
              }
          }
          else {
              $message = "Email already exists.";
              $path = "/blogger/views/register.php";
          }
  
  }
  else {
      $message = "Data is missing";
      $path = "/blogger/views/register.php";
  }
  
  $_SESSION["message"] = $message;
  header("location: $path");
}

if(isset($_POST["loginform"])) {
  // Login
  $message = "Invalid email or password !";
  $path = "/blogger/views/login.php";

  // Validate Data
  $form_is_valid = checkForm($_POST, [ "email", "password"]);
  
  if($form_is_valid) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = getUserByEmail($email);

    if($user) {
      if($user['password'] === $password) {
        $message = "You've logged in successfully";
        $path = "/blogger";
        $_SESSION["user"] = $user;
      }
    }
    else {
      $message = "Account does not exist ! please create a new account.";
      $path = "/blogger/views/register.php";
    }
  }

  $_SESSION["message"] = $message;
  header("location: $path");      

}

if(isset($_POST['logout'])) {
  unset($_SESSION['user']);
  $_SESSION['message'] = "You've signed out";
  header('location: /blogger');
}
?>