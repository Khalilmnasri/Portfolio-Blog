<?php

include("db.php");

function create_user($username, $email, $password) {
    global $bdd;
    $requete = $bdd->prepare("INSERT INTO users(username, email, password) VALUES (?, ?, ?)");
    $requete->execute([$username, $email, $password]);

}

function getUserByEmail($email) {
  global $bdd;
  $email = $_POST['email'];
  
    $requete = $bdd->prepare("SELECT * FROM users WHERE email = ?");
    $requete->execute([$email]);
    $user = $requete->fetch(PDO::FETCH_ASSOC);

    if($user != 0) {
      return $user;
    }
 
}