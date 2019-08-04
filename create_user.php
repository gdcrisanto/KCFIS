
<?php
 require "template.php";
 headertag("Create User");
?>


    <div class="container form-box">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Create New User
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
          else if ($_GET['error'] == "usernametaken") {
            echo '<div class="row form-group">
                    <div class="col-sm-12 text-center error">
                      Username already taken
                    </div>
                  </div>';
          }
          else if ($_GET['error'] == "passwordcheck") {
            echo '<div class="row form-group">
                    <div class="col-sm-12 text-center error">
                      Password and Confirm Password do not match
                    </div>
                  </div>';
          }
          else if ($_GET['error'] == "invalidusername") {
            echo '<div class="row form-group">
                    <div class="col-sm-12 text-center error">
                      Username is invalid
                    </div>
                  </div>';
          }
        }
      ?>

      <form role="form" method="post" action="includes/create_user.inc.php">

        <div class="row">
          <label for="fname" class="col-sm-5 offset-sm-1">First Name:
            <input type="text" class="form-control" id="fname" name="fname">
          </label>
          <label for="mname" class="col-sm-5">Middle Name:
            <input type="text" class="form-control" id="mname" name="mname">
          </label>
        </div>

        <div class="row form-group">
          <label for="lname" class="col-sm-5 offset-sm-1">Last Name:
            <input type="text" class="form-control" id="lname" name="lname">
          </label>
          <label for="contactno" class="col-sm-5">Contact No.:
            <input type="text" class="form-control" id="contactno" name="contactno">
          </label>
        </div>

        <div class="row pt-sm-3">
          <label for="user" class="col-sm-5 offset-sm-1">Username:
            <input type="text" class="form-control" id="user" name="user">
          </label>
          <label for="password" class="col-sm-5">Password:
            <input type="password" class="form-control" id="password" name="password">
          </label>
        </div>

        <div class="row form-group">
          <label for="usertype" class="col-sm-5 offset-sm-1" id="usertype">User Type:
            <select class="form-control" name="usertype">
              <option value="" disabled="true" selected="selected"> -- Select an option -- </option>
              <option value="Cashier">Cashier</option>
              <option value="Data Encoder">Data Encoder</option>
              <option value="Accounting Supervisor">Accounting Supervisor</option>
              <option value="Finance Admin">Finance Admin</option>
              <option value="System Admin">System Admin</option>
            </select>
          </label>
          <label for="confirmpassword" class="col-sm-5">Confirm Password:
            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
          </label>
        </div>

        <div class="row pt-sm-3">
          <div class="col-sm-2 offset-sm-5">
            <input type="submit" value="Submit" name="create_user_submit" class="btn btn-primary btn-block"/>
          </div>
        </div>

      </form>

    </div>

    <?
    footertag();
    ?>
