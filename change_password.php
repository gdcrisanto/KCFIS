<!DOCTYPE html>
<?php
  require "template.php";
  headertag("Change Password");
 ?>

    <div class="container login-box">


      <div class="row form-group">
        <div class="col-sm-12 text-center form-title h3">
          Change Password
        </div>
      </div>

      <?php
        if (isset($_GET['error'])) {
          if ($_GET['error'] == "emptyfields") {
            echo '<div class="row form-group">
                    <div class="col-sm-12 text-center error">
                      Enter username and password
                    </div>
                  </div>';
          }
        }
      ?>

      <form role="form" method="post" action="includes/change_password.inc.php">

        <div class="form-group row">
          <label class="col-sm-10 offset-sm-1">
            New Password:
            <input type="password" class="form-control text-center" name="newpass">
          </label>
        </div>
        <div class="form-group row">
          <label class="col-sm-10 offset-sm-1">
            Confirm New Password:
            <input type="password" class="form-control text-center" name="confirmpass">
          </label>
        </div>
        <div class="form-group row">
          <div class="col-sm-8 offset-sm-2">
            <input type="submit" value="Submit" name="new_pass_submit" class="btn btn-primary btn-block"/>
          </div>
        </div>
        <div class="form-group row">
          <a href='index.php' class="col-sm-4 offset-sm-4 btn btn-danger btn-block"/>
          Cancel
          </a>
        </div>

      </form>

    </div>
<?
  footertag();
?>
