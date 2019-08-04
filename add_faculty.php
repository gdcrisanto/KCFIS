
<?php
  require_once "template.php";
  headertag("Add Faculty Information");
?>


    <div class="container form-box">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Add Faculty Information
        </div>
      </div>

      <?php
        if (isset($_GET['error'])) {
          if ($_GET['error'] == "emptyfields") {
            echo '<div class="row form-group">
                    <div class="col-sm-12 text-center error">
                      Fill up all fields
                    </div>
                  </div>';
          }
        }
      ?>

      <form role="form" method="post" action="includes/add_faculty.inc.php">

        <div class="row">
          <label for="employeeID" class="col-sm-5 offset-sm-1">Employee ID:
            <input type="text" class="form-control" id="employeeID" name="employeeID">
          </label>
        </div>

        <div class="row">
          <label for="fname" class="col-sm-5 offset-sm-1">First Name:
            <input type="text" class="form-control" id="fname" name="fname">
          </label>
          <label for="mname" class="col-sm-5">Middle Name:
            <input type="text" class="form-control" id="mname" name="mname">
          </label>
        </div>

        <div class="row">
          <label for="lname" class="col-sm-5 offset-sm-1">Last Name:
            <input type="text" class="form-control" id="lname" name="lname">
          </label>
          <label for="contactno" class="col-sm-5">Contact No.:
            <input type="text" class="form-control" id="contactno" name="contactno">
          </label>
        </div>

        <div class="row form-group">
          <label for="address" class="col-sm-10 offset-sm-1">Address:
            <input type="text" class="form-control" id="address" name="address">
          </label>
        </div>

        <div class="row pt-sm-3">
          <div class="col-sm-2 offset-sm-5">
            <input type="submit" value="Submit" name="add_faculty_submit" class="btn btn-primary btn-block"/>
          </div>
        </div>

      </form>

    </div>
<?
  footertag();
?>
