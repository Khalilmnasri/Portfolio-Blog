<?php

if(!isset($_SESSION));
session_start();

include("../helper/validation.php");
include("../database/article.php");

if(isset($_POST['post-create-form'])) {
  $path = "/blogger/views/article/index.php";
  $message = "Article is create successfully";
  // Validation
  $form_is_valid = checkForm($_POST, ["title", "body"]);

  if($form_is_valid) {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $image = $_FILES['image'];

    // INSERT IMAGE
    $oldPath  = $image["tmp_name"];
    $filename = $image["name"];
    $new_path = "../public/$filename";
    move_uploaded_file($oldPath, $new_path);

    // INSERT ARTICLE
    $user_id    = $_SESSION['user']['id'];
    $article_id = create_article($title, $body, $filename, $user_id);

     if($article_id == 0) {
      $message = 'Something went wrong !';
      $path    = '/blogger/views/article/create.php';
      }

    else {
      $path = "/blogger/views/article/show.php?id=$article_id";
    }
    
  }
  else {
    $message = "Invalid data";
    $path = "/blogger/views/article/create.php";
  }

  // message invalid, location: create.php
  $_SESSION["message"] = $message;
  header("location: $path");   
 
}

if(isset($_POST['post-update-form'])) {

  $message = "Unable to update article.";
  $path    = "/blogger/views/article/index.php";
  
  if(isset($_SESSION["user"]))  {
    // GET article by id
    $form_is_valid = checkForm($_POST, ["title", "body", "image", "article_id"]);

    if($form_is_valid) {
      $article_id = $_POST['article_id'];
      $title      = $_POST["title"];
      $body       = $_POST["body"];
      $image      = $_POST["image"];

      $article = findArticleById($article_id);

      if($article) {
        $is_updated = update_article($title, $body, $image, $article_id);
        $path = "/blogger/views/article/show.php?id=$article_id";
        $message = "Article updated successfully";

      }
      else {
        $message = "404 Article Is Not Found";
      }
    }
    // Check article.user_id == session.user.id
    
  }
  else {
    $_SESSION['message'] = "403 Unauthorized Acces.";
    header('HTTP/1.1 403', true, 403);
    header("location: /blogger/views/article/index.php");
  }

  $_SESSION["message"] = $message;
  header("location: $path");
}

if(isset($_POST['post-delete-form'])) {

  $message = "Unable to delete article.";
  $path    = "/blogger/views/article/index.php";
  
  if(isset($_POST["_method"]) && $_POST["_method"] == "DELETE") {
    
    if(isset($_SESSION["user"]) && isset($_POST["article_id"])) {
      
      $article_id = $_POST["article_id"];
      $article = findArticleById($article_id);

      if($article) {
        if($_SESSION["user"]["id"] == $article["user_id"]) {
          $is_deleted = deleteArticle($article_id);

          if($is_deleted) {
            $message = "Article is DELETED Successfully";
          }
        }
        else {
          $_SESSION['message'] = "403 Unauthorized Acces.";
          header('HTTP/1.1 403', true, 403);
          header("location: /blogger/views/article/index.php");
        }
      }
      else {
        $message = "404 Article Is Not Found";
      }
    }
 
  }
  $_SESSION["message"] = $message;
  header("location: $path");
}

if (isset($_POST["comment"])) {
  if(isset($_POST['pseudo'],$_POST['content']) AND !empty($_POST['pseudo']) AND !empty($_POST['content'])) {

    $pseudo = $_POST['pseudo'];
    $commentary = htmlspecialchars($_POST['content']);

    $comment_id = ajout_comment($pseudo, $commentary, $idArticle);
 
  // $form_is_valid = checkForm($_POST, ["comment"]);

  // if($form_is_valid) {

  //   $id = $_POST["id_article"];
  //   $commentUsername = $_POST["username"];
  //   $commentContent  = $_POST["comment"];
  //   $commentDate    = date('Y-m-d H:i:s');
  //   $idArticle      = $_POST["id_article"];
  // }

  // $comment_id = ajout_comment($commentUsername, $commentContent, $commentDate, $idArticle);

  // header("Location: /blogger/views/article/show.php?id=$id", true, 301);
  // exit;
                

}
}
?>