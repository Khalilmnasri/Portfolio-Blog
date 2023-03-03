<?php

include("db.php");

function create_article($title, $body, $image, $user_id) {
  global $bdd;

  $requete = $bdd->prepare('INSERT INTO articles(title, body, image, user_id) VALUES (?, ?, ?, ?)');
  $requete->execute([$title, $body, $image, $user_id]);
  $result = $bdd->lastInsertId();
  
  return $result;
}

function findArticleById($id) {
  global $bdd;

  $requete = $bdd->prepare("SELECT articles.id, articles.title, articles.body, articles.image, articles.user_id, articles.created_at, users.username FROM articles JOIN users ON articles.user_id = users.id WHERE articles.id = ?");
  $requete->execute([$id]);
  $result = $requete->fetch(PDO::FETCH_ASSOC);

   if($result != 0) {
     return $result;
   }
}

function getAllArticles() {
  global $bdd;
  
  $requete = $bdd->query("SELECT articles.id, articles.title, articles.body, articles.image, users.username  FROM articles JOIN users ON articles.user_id = users.id");
  $result = $requete->fetchAll();
  
  return $result;
}

function update_article($title, $body, $image, $article_id) {
  global $bdd;

$requete = $bdd->prepare("UPDATE articles SET title = ?, body = ?, image = ? WHERE id = ?");

$result = $requete->execute([$title, $body, $image, $article_id]);
  
return $result;

if($result) {
  return true;
}
else {
  return false;
}

}
    
function deleteArticle($id) {
  global $bdd;

  $requete = $bdd->prepare("DELETE FROM articles WHERE id = ?;");
  $requete->execute([$id]);

 return true;
}

// function ajout_comment($commentUsername, $commentContent, $commentDate, $idArticle) {
//   global $bdd;

//   $requete = $bdd->prepare("SELECT * FROM `articles` INNER JOIN `comments` WHERE `articles`.`article_id`= `comments`.`id_article` AND `articles`.`article_id` = ? ORDER BY comment_id DESC");
  
//   $requete->execute([$commentUsername, $commentContent, $commentDate, $idArticle]);
//   $comments = $requete->fetchAll();

//   return $comments;

function ajout_comment($pseudo, $commentary, $idArticle) {

  $requete = $bdd->prepare('INSERT INTO comments (pseudo, content, id_article) VALUES (?,?,?)');
  $result = $requete->execute([$pseudo, $commentary, $idArticle]);

  return $result;
}

function getComments() {
  global $bdd;

  $requete = $bdd->prepare('SELECT * FROM comments WHERE id_article = ? ORDER BY id DESC');
  $requete->execute();
  $result = $requete->fetch();

  return $result;
}