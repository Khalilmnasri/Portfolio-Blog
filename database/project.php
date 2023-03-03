<?php

include("db.php");

function create_project($projectName, $websitelink, $image, $user_id) {
  global $bdd;

  $requete = $bdd->prepare('INSERT INTO projects(project_name, websitelink, image, user_id) VALUES (?, ?, ?, ?)');
  $requete->execute([$projectName, $websitelink, $image, $user_id]);
  $result = $bdd->lastInsertId();
  
  return $result;
}

function findProjectById($id) {
  global $bdd;

  $requete = $bdd->prepare("SELECT projects.id, projects.project_name, projects.websitelink, projects.image, projects.user_id, projects.created_at, users.username FROM projects JOIN users ON projects.user_id = users.id WHERE projects.id = ?");
  $requete->execute([$id]);
  $result = $requete->fetch(PDO::FETCH_ASSOC);

   if($result != 0) {
     return $result;
   }
}

function getAllProjects() {
  global $bdd;
  
  $requete = $bdd->query("SELECT projects.id, projects.project_name, projects.websitelink, projects.image, users.username  FROM projects JOIN users ON projects.user_id = users.id");
  $result = $requete->fetchAll();
  
  return $result;
}

function update_project($projectName, $websitelink, $image, $project_id) {
  global $bdd;

$requete = $bdd->prepare("UPDATE projects SET project_name = ?, websitelink = ?, image = ?, WHERE id = ?");

$result = $requete->execute([$projectName, $websitelink, $image, $project_id]);
  
return $result;

if($result) {
  return true;
}
else {
  return false;
}

}
    
function deleteProject($id) {
  global $bdd;

  $requete = $bdd->prepare("DELETE FROM projects WHERE id=?");
  $requete->execute([$id]);

 return true;
 
}