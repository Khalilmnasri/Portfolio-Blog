<?php

if(!isset($_SESSION)) {
session_start();
}

include_once('../../includes/header.php');
include_once('../../database/article.php');


$redirect = true;
if(isset($_GET["id"])) {
  $id = $_GET["id"];
  $article = findArticleById($id);

    if($article) {
     $redirect = false;
    }
}

if(!isset($_SESSION["user"]) || $_SESSION["user"]["id"] != $article["user_id"]) {
  $_SESSION["message"] = "403 Unauthorized Acces.";
  header("HTTP/1.1 403", true, 403);
  header("location: /blogger/views/article/index.php");

}
   if($redirect)  {
    header("HTTP/1.1 404", true, 404);
    header ("location: /blogger/views/404.php");
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://cdn.tiny.cloud/1/25ixjvlifnn3dv6aacu9h4e5qmjvngabytsixiakb3gfglu7/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>

  <script>
  tinymce.init({
    selector: '#mytextarea'
  });
  </script>

</head>

<body>
  <div class="row">
    <h1>Update Article</h1>
    <div class="col-md-8 col-md-offset-2">
      <br><br><br>
      <form action="/blogger/controller/article.php" method="POST" id="postForm">
        <div class="form-group">
          <label for="title">Title <span class="require">*</span></label>
          <input type="text" id="title" value="<?= $article["title"] ?>" class="form-control" required name="title" />
        </div>

        <div class="form-group mt-2">
          <label for="image">Image link</label>
          <input type="file" class="form_control" name="image" value="<?= $filename?>" />
        </div>

        <input type="hidden" name="article_id" value="<?= $article["id"] ?>" />

        <div class="form-group">
          <label for="body"></label>
          <textarea id="mytextarea" rows="5" class="form-control" required
            name="body"><?= $article["body"] ?></textarea>
        </div>

        <div class="form-group">
          <input type="submit" name='post-update-form' id="post-btn" class="btn btn-primary" value='Update'>
          <a href="/" class="btn btn-default">Cancel</a>
        </div>
      </form>
    </div>
  </div>
  <br><br>

</body>

</html>

<?php

include_once('../../includes/footer.php');

?>