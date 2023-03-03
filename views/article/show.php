<?php

include_once('../../includes/header.php');
include('../../database/article.php');

 $redirect = true;
if(isset($_GET["id"])) {
  $id = $_GET["id"];
  $article = findArticleById($id);

    if($article) {
     $redirect = false;
    }
}
   if($redirect)  {
    header("HTTP/1.1 404", true, 404);
    header ("location: /blogger/views/404.php");
  }

?>

<section class="mt-4">
  <!--Grid row-->
  <div class="row">

    <!--Grid column-->
    <div class="col-md-8 mb-4">
      <h3 class="my-2"><?= $article["title"] ?></h3>
      <small id="article-meta">By
        <strong>
          @<?=$article["username"]?>
        </strong>
        , on <?= date("Y-m-d", strtotime($article["created_at"])) ?>
      </small>

      <!--Featured Image-->
      <div class="card my-4 mb-4">

        <img src="/blogger/public/<?= $article["image"] ?>">

      </div>
      <!--/.Featured Image-->

      <?php if(isset($_SESSION["user"]) && $_SESSION["user"]["id"] == $article["user_id"]) { ?>
      <div class="card my-4 mb-4">
        <div class="row">
          <div class="col-md-6">
            <a href="/blogger/views/article/edit.php?id=<?= $article["id"] ?>"><button class="btn btn-primary"
                style="width:100%;">Edit</button></a>
          </div>
          <div class="col-md-6">
            <form action="/blogger/controller/article.php" method="POST">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="article_id" value="<?= $article["id"] ?>">
              <input type=" submit" style="width:100%;" class="btn btn-danger" name="post-delete-form" value="DELETE">
            </form>
          </div>
        </div>
      </div>
      <?php } ?>
      <!--Card-->
      <div class="card mb-4">

        <!--Card content-->
        <div class="card-body"><?=$article["body"]?></div>


      </div>

      <!-- Comments -->
      <?php if(!isset($_SESSION["user"]) || $_SESSION["user"]["id"] != $article["user_id"]) { ?>

      <div id="comment" class="row">
        <div class="col-lg-12 border p-4 mt-3 bg-white">

          <div class="comments">
            <h2 class="text-center text-muted py-3">Comments</h2>

            <?php while($comment = getComments()) { ?>

            <div class="card mb-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-10">
                    <p>
                      <a class="float-left" href="#"><strong><?= $comment['pseudo'] ?></strong></a>
                      <span
                        class="float-right px-2 text-muted"><?= date_format(date_create($comment['comment_date']), "d F Y h:i") ?></span>
                    </p>
                    <div class="clearfix"></div>
                    <p class="text-secondary mt-2"><?= $comment['content'] ?></p>
                  </div>
                </div>

              </div>
            </div>

            <?php } ?>
          </div>

          <div class="post-comments">
            <form action="assest/insert.php?type=comment&id=<?= $article_id ?>#comment" method="POST">
              <div class="form-group mt-3">
                <input type="hidden" name="username" value="<?= rand() ?>">
                <input type="hidden" name="id_article" value="<?= $article_id ?>">
                <textarea name="comment" class="form-control" rows="3" placeholder="Add your comment..."></textarea>
                <button name="comment" type="submit" class="btn btn-outline-secondary float-right mt-2">Add
                  Comment</button>
              </div>
              <div class="clearfix"></div>
            </form>
          </div>

        </div>
      </div><!-- /Comments -->
      <?php } ?>

    </div>

  </div>
  <!--Grid column-->

  </div>
  <!--Grid row-->

</section>
<!--Section: Post-->

<?php

include_once('../../includes/footer.php');

?>