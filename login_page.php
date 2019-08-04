<!DOCTYPE html>
<?php
  require "template.php";
  headertag("Login Page");
 ?>

    <div class="container login-box">

      <div class="row form-group">
        <div class="col-sm-4 offset-sm-4 text-center">
          <img src="photos/kc_logo_2.jpg" width="70" height="70"class="img-responsive rounded-circle">
        </div>
      </div>

      <div class="row form-group">
        <div class="col-sm-12 text-center h6">
          Kalayaan College Financial Information System
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
          else if ($_GET['error'] == "invusrpass") {
            echo '<div class="row form-group">
                    <div class="col-sm-12 text-center error">
                      Invalid username or password
                    </div>
                  </div>';
          }
        }
      ?>

      <form role="form" method="post" action="includes/login.inc.php">

        <div class="form-group row">
          <div class="col-sm-10 offset-sm-1">
            <input type="text" class="form-control text-center" id="loginuser" name="user" placeholder="username">
            <input type="password" class="form-control text-center" id="loginpassword" name="password" placeholder="password">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10 offset-sm-1">
            <input type="submit" value="Log in" name="login_submit" class="btn btn-primary btn-block"/>
          </div>
        </div>

      </form>

    </div>
<?
  footertag();
?>
