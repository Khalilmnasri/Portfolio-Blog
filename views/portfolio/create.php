<?php

include("../../includes/header.php");

?>

<div class="row">
  <h1>Add Project</h1>
  <div class="col-md-8 col-md-offset-2">
    <br><br>
    <form action="/blogger/controller/project.php" method="POST" id="postForm" novalidate enctype="multipart/form-data">
      <div class="form-group">
        <label for="project_name">Project Name <span class="require">*</span></label>
        <input type="text" id="title" class="form-control" required name="project_name" />
      </div>

      <div class="form-group m-3">
        <label for="image">Image link</label>
        <input type="file" class="" name="image" />
      </div>

      <div class="mb-3">
        <label for="websitelink" class="form-label">Website link:</label>
        <input type="text" name="websitelink" class="form-control" value="" id="websitelink">
      </div>
      <br>

      <div class="form-group">
        <input type="submit" name='post-create-form' id="post-btn" class="btn btn-primary" value='Create'>
        <!-- </button> -->
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