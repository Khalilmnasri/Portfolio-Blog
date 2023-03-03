<?php

if(!isset($_SESSION));
session_start();

include("../helper/validation.php");
include("../database/project.php");

if(isset($_POST['post-create-form'])) {
  $path = "/blogger";
  $message = "Project is added successfully";
  // Validation
  $form_is_valid = checkForm($_POST, ["project_name", "websitelink"]);

  if($form_is_valid) {
    $projectName = $_POST['project_name'];
    $websitelink = $_POST['websitelink'];
    $image = $_FILES['image'];

    // INSERT IMAGE
    $oldPath  = $image["tmp_name"];
    $filename = $image["name"];
    $new_path = "../public/$filename";
    move_uploaded_file($oldPath, $new_path);

    // INSERT PROJECT
    $user_id    = $_SESSION['user']['id'];
    $project_id = create_project($projectName, $websitelink, $filename, $user_id);

     if($project_id == 0) {
      $message = 'Something went wrong !';
      $path    = '/blogger/views/portfolio/create.php';
      }

    else {
      $path = "/blogger/views/portfolio/show.php?id=$project_id";
    }
    
  }
  else {
    $message = "Invalid data";
    $path = "/blogger/views/portfolio/create.php";
  }

  // message invalid, location: create.php
  $_SESSION["message"] = $message;
  header("location: $path");   
 
}

if(isset($_POST['post-update-form'])) {

  $message = "Unable to update project.";
  $path    = "/blogger";
  
  if(isset($_SESSION["user"]))  {
    // GET article by id
    $form_is_valid = checkForm($_POST, ["project_name", "websitelink", "image", "project_id"]);

    if($form_is_valid) {
      $project_id        = $_POST['project_id'];
      $ProjectName       = $_POST["project_name"];
      $websitelink       = $_POST["websitelink"];
      $image             = $_POST["image"];

      $project = findProjectById($project_id);

      if($project) {
        $is_updated = update_project($ProjectName, $websitelink, $image, $project_id);
        $path = "/blogger/views/portfolio/show.php?id=$project_id";
        $message = "Project updated successfully";

      }
      else {
        $message = "404 Project Is Not Found";
      }
    }
    
  }
  else {
    $_SESSION['message'] = "403 Unauthorized Acces.";
    header('HTTP/1.1 403', true, 403);
    header("location: /blogger");
  }

  $_SESSION["message"] = $message;
  header("location: $path");
}

if(isset($_POST['post-delete-form'])) {

  $message = "Unable to delete project.";
  $path    = "/blogger";
  
  if(isset($_POST["_method"]) && $_POST["_method"] == "DELETE") {
    
    if(isset($_SESSION["user"]) && isset($_POST["project_id"])) {
      
      $project_id = $_POST["project_id"];
      $project = findProjectById($project_id);

      if($project) {
        if($_SESSION["user"]["id"] == $project["user_id"]) {
          $is_deleted = deleteProject($project_id);

          if($is_deleted) {
            $message = "Project is DELETED Successfully";
          }
        }
        else {
          $_SESSION['message'] = "403 Unauthorized Acces.";
          header('HTTP/1.1 403', true, 403);
          header("location: /blogger");
        }
      }
      else {
        $message = "404 Project Is Not Found";
      }
    }
 
  }
  $_SESSION["message"] = $message;
  header("location: $path");
}

?>