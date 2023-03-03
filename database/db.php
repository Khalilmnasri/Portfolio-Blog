<?php

try{
  $bdd = new PDO('mysql:host=localhost;dbname=blogger;charset=utf8','root','');
}
 catch(Exception $e){
  die("ERROR: Could not connect. " . $e->getMessage());
}

?>