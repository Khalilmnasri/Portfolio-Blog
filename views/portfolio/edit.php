<?php

if(!isset($_SESSION)) {
session_start();
}

include_once('../../includes/header.php');
include_once('../../database/project.php');


$redirect = true;
if(isset($_GET["id"])) {
  $id = $_GET["id"];
  $project = findProjectById($id);

    if($project) {
     $redirect = false;
    }
}

if(!isset($_SESSION["user"]) || $_SESSION["user"]["id"] != $project["user_id"]) {
  $_SESSION["message"] = "403 Unauthorized Acces.";
  header("HTTP/1.1 403", true, 403);
  header("location: /blogger");

}
   if($redirect)  {
    header("HTTP/1.1 404", true, 404);
    header ("location: /blogger/views/404.php");
  }

?>

<div class="row">
  <h1>Update Project</h1>
  <div class="col-md-8 col-md-offset-2">
    <br><br><br>
    <form action="/blogger/controller/project.php" method="POST" id="postForm">
      <div class="form-group">
        <label for="project_name">Project Name <span class="require">*</span></label>
        <input type="text" id="title" value="<?= $project["project_name"] ?>" class="form-control" required
          name="project_name" />
      </div>

      <div class="form-group">
        <label for="image">Image link</label>
        <input type="file" class="form_control" name="image" value="<?= $filename?>" />
      </div>

      <input type="hidden" name="project_id" value="<?= $Project["id"] ?>" />

      <div class="mb-3">
        <label for="websitelink" class="form-label">Website link:</label>
        <input type="text" name="websitelink" class="form-control" value="<?= $project["websitelink"] ?>"
          id="websitelink">
      </div>
      <br>

      <div class="form-group">
        <input type="submit" name='post-update-form' id="post-btn" class="btn btn-primary" value='Update'>
        <!-- </button> -->
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