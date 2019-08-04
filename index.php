<?php
  require "template.php";
  headertag("Home");
?>

      <div class="container form-box-md">

        <?php

          if (isset($_SESSION['usertype'])){
            ?>
            <div>
              <div class="row">
                <div class="h3 col-sm-12 text-center">
                  Kalayaan College
                </div>
                <div class="h3 col-sm-12 text-center">
                  Financial Information System
                </div>
                <div class="h3 col-sm-12 text-center">
                  (K.C.F.I.S.)
                </div>
              </div>
            </div>

            <div class="h3 row form-group text-center">
              <div class="col-sm-10 offset-sm-1">
                <img src="photos/KC_logo_2.jpg" width="150" height="150" class="rounded-circle d-inline-block align-top">
              </div>
            </div>

            <div class="row form-group mt-sm-4">
              <a class="col-sm-4 offset-sm-4 btn btn-secondary btn-block" href="view_user.php">
                User Profile
              </a>
            </div>
            <div class="row form-group">
              <a class="col-sm-4 offset-sm-4 btn btn-secondary btn-block" href="change_password.php">
                Change Password
              </a>
            </div>

            <?php
          }
          else {
            echo '<p>You are logged out!</p>';
          }
        ?>

      </div>

      <?php
      if (isset($_GET['changepass'])) {
        if ($_GET['changepass'] == "success") {
          ?>
          <div class="alert alert-success alert-dismissible fade show">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Change Password Success!</strong>
          </div>
          <?php
        }
      }
      ?>

<?php
  footertag();
 ?>
