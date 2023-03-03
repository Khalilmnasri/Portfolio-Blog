<?php 

if(!isset($_SESSION)) {
  session_start();
}

?>

<!DOCTYPE html>
<html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="/blogger/assets/css/layout.css">

</head>

<body>
  <!--Main Navigation-->
  <header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark scrolling-navbar">
      <div class="container">

        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="/blogger">
          <strong class="blue-text">Blogfolio</strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item active">
              <a class="nav-link waves-effect" href="/blogger">Home
              </a>
            </li>

            <?php if(isset($_SESSION['user'])) { ?>
            <li class="nav-item">
              <a class="nav-link waves-effect" href="/blogger/views/portfolio/create.php">Add Project</a>
            </li>

            <li class="nav-item">
              <a class="nav-link waves-effect" href="/blogger/views/article/create.php">Create Article</a>
            </li>

            <li class="nav-item">
              <a class="nav-link waves-effect" href="/blogger/views/article/index.php">My Blog</a>
            </li>
            <?php } ?>
          </ul>

          <?php if(!isset($_SESSION['user'])) { ?>
          <ul class="navbar-nav me-auto">

            <li class="nav-item">
              <a class="nav-link waves-effect" href="/blogger/views/article/index.php">My Blog</a>
            </li>
          </ul>
          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
              <a href="/blogger/views/login.php" class="nav-link waves-effect">Login</a>
            </li>
            <li class="nav-item">
              <a href="/blogger/views/register.php" class="nav-link waves-effect">Register</a>
            </li>
          </ul>
          <?php } else { ?>
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
              <a href="#" class="nav-link waves-effect">
                Welcome <?= $_SESSION['user']['username'] ?>
              </a>
            </li>
            <li class="nav-item">
              <form action="/blogger/controller/auth.php" method="post">
                <input type="hidden" name="logout" value="logout">
                <button type="submit" name="logout" href="/logout.php"
                  class="nav-link waves-effect bg-transparent border-0" style="cursor: pointer">Logout</button>
              </form>
            </li>
          </ul>
          <?php } ?>

        </div>

      </div>
    </nav>
    <!-- Navbar -->

  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="mt-5 pt-5">
    <div class="container">
      <!-- Alert Message -->
      <?php 
      if(!empty($_SESSION["message"])) { ?>
      <div class="alert alert-info text-center">
        <?= $_SESSION["message"] ?>
      </div>
      <?php } ?>

      <!-- End Message -->
      <?php
      $_SESSION["message"] = "";
      ?>