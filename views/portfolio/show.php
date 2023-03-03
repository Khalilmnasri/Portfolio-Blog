<?php

include_once('../../includes/header.php');
include('../../database/project.php');

 $redirect = true;
if(isset($_GET["id"])) {
  $id = $_GET["id"];
  $project = findProjectById($id);

    if($project) {
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
      <h3 class="my-2"><?=$project["project_name"]?></h3>
      <small id="article-meta">By
        <strong>
          @<?=$project["username"]?>
        </strong>
        , on <?= date("Y-m-d", strtotime($project["created_at"])) ?>
      </small>

      <!--Featured Image-->
      <div class="card my-4 mb-4">

        <img src="/blogger/public/<?= $project["image"] ?>">

      </div>
      <!--/.Featured Image-->

      <?php if(isset($_SESSION["user"]) && $_SESSION["user"]["id"] == $project["user_id"]) { ?>
      <div class="card my-4 mb-4">
        <div class="row">
          <div class="col-md-6">
            <a href="/blogger/views/portfolio/edit.php?id=<?= $project["id"] ?>"><button class="btn btn-primary"
                style="width:100%;">Edit</button></a>
          </div>
          <div class="col-md-6">
            <form action="/blogger/controller/project.php" method="POST">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="project_id" value="<?= $project["id"] ?>">
              <input type=" submit" style="width:100%;" class="btn btn-danger" name="post-delete-form" value="DELETE">
            </form>
          </div>
        </div>
      </div>
      <?php } ?>
      <!--Card-->
      <div class="card mb-4">

        <!--Card content-->
        <div class="card-body"><a href="<?=$project["websitelink"]?>"><?=$project["websitelink"]?></a></div>


      </div>


      <!--/.Card-->

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