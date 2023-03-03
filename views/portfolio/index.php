<?php 

require_once('includes/header.php');
include('database/project.php');

$projects = getAllProjects();

?>

<?php if(count($projects) == 0) { ?>

<div class="text-center">
  <h2>There are not projects.</h2>
</div>

<?php } ?>

<div class="container">
  <div class="row">
    <h1>Welcome To My World</h1><br>
    <small>These are all the projects I've made. Some may have been made for friends, some just for fun and some as
      freelance jobs.</small>
    <div class="row justify-content-center">

      <?php foreach($projects as $project) { ?>
      <div class="col-md-6 col-lg-4">
        <div class="card-content">
          <div class="card-img">
            <img src="/blogger/public/<?= $project['image'] ?>" alt="">
            <span class="username">
              <h4><a href="#" class="username_url">@<?=$project['username']?></a></h4>
            </span>
          </div>
          <div class="card-desc text-center">
            <h3><?= $project['project_name'] ?></h3>
            <br>
            <a href="/blogger/views/portfolio/show.php?id=<?= $project['id'] ?> " class="btn-card">Go Ahead</a>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>

<?php 

require_once('includes/footer.php');

?>