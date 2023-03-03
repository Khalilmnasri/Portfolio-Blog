<?php

include("../../includes/header.php");

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
    <h1>Create Article</h1>
    <div class="col-md-8 col-md-offset-2">
      <br><br>
      <form action="/blogger/controller/article.php" method="POST" id="postForm" novalidate
        enctype="multipart/form-data">
        <div class="form-group">
          <label for="title">Title <span class="require">*</span></label>
          <input type="text" id="title" class="form-control" required name="title" />
        </div>

        <div class="form-group m-3">
          <label for="image">Image link</label>
          <input type="file" class="" name="image" />
        </div>

        <div class="form-group">
          <label for="body"></label>
          <textarea id="mytextarea" rows="5" class="form-control" required name="body"></textarea>
        </div>

        <br>

        <div class="form-group">
          <input type="submit" name='post-create-form' id="post-btn" class="btn btn-primary" value='Create'>
          <a href="/" class="btn btn-default">Cancel</a>
        </div>
      </form>
      <br><br>
    </div>
  </div>

</body>

</html>

<?php

include("../../includes/footer.php");

?>