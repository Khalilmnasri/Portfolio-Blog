<?php

$bdd = new PDO('mysql:host=localhost;dbname=blogger;charset=utf8','root','');


//  Create users table

$query = "CREATE TABLE users (
id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
username VARCHAR(121),
email VARCHAR(121),
password VARCHAR(121),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()
)";


// create articles table

$query = "CREATE TABLE articles (
    id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(121),
    body TEXT,
    image VARCHAR(121),
    user_id INTEGER UNSIGNED,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),

//     FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
// )";


// create projects table

$query = "CREATE TABLE projects (
  id INTEGER UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  project_name VARCHAR(121),
  websitelink TEXT,
  image VARCHAR(121),
  user_id INTEGER UNSIGNED,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),

//     FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
// )";

// create comments table

$query = "CREATE TABLE comments (
  comment_id INTEGER  PRIMARY KEY AUTO_INCREMENT,
  pseudo VARCHAR(100),
  content TEXT,
  comment_date datetime CURRENT_TIMESTAMP(),
  id_article INTEGER )";