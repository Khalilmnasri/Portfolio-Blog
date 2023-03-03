<?php 

require_once('../../includes/header.php');
include('../../database/article.php');

$articles = getAllArticles();

?>

<?php if(count($articles) == 0) { ?>

<div class="text-center">
  <h2>There are not articles.</h2>
</div>

<?php } ?>


<div class="row justify-content-center">
  <?php foreach($articles as $article) { ?>
  <div class="col-md-6 col-lg-4">
    <div class="card-content">
      <div class="card-img">
        <img src="/blogger/public/<?= $article['image'] ?>" alt="">
        <span class="username">
          <h4><a href="#" class="username_url">@<?= $article['username'] ?></a></h4>
        </span>
      </div>
      <div class="card-desc text-center">
        <h3><?= $article['title'] ?></h3>
        <p><?= substr($article['body'], 0, 30) ?>...</p>
        <a href="/blogger/views/article/show.php?id=<?= $article['id'] ?> " class="btn-card">Read</a>
      </div>
    </div>
  </div>
  <?php } ?>
</div>

<?php 

require_once('../../includes/footer.php');

?>