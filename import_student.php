<!DOCTYPE html>
<?php
  require "template.php";
  headertag("Import Student Info");
 ?>

    <div class="container login-box">


      <div class="row form-group">
        <div class="col-sm-12 text-center form-title h3">
          Import Student Info
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

      <form role="form" method="post" action="includes/import_student.inc.php" enctype="multipart/form-data">

        <div class="row form-group">
          <label for="exampleFormControlFile1" class="col-sm-8 offset-sm-2 text-center">(.csv files only)
            <input type="file" class="form-control-file" name="studentcsv">
          </label>
        </div>

        <div class="form-group mb-sm-1">
          <div class="col-sm-6 offset-sm-3">
            <input type="submit" value="Import" name="import_student_submit" class="btn btn-primary btn-block"/>
          </div>
        </div>
        <div class="form-group row">
          <a href='search_student.php' class="col-sm-4 offset-sm-4 btn btn-danger btn-block"/>
          Cancel
          </a>
        </div>

      </form>

    </div>
<?
  footertag();
?>
