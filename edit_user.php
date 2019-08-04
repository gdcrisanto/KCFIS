
<?php
  require "template.php";
  require 'includes/db.inc.php';
  headertag("Edit User");
  $sql = "SELECT *
          FROM userinfotab
          WHERE userID=? ";

  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("login_page.php?error=sqlerror");
    exit();
  }
  else {
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['userID']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
      $fname = $row['fname'];
      $mname = $row['mname'];
      $lname = $row['lname'];
      $lname = $row['lname'];
      $contactno = $row['contactno'];
      $birthdate = $row['birthdate'];
      $gender = $row['gender'];
      $address = $row['address'];
      $birthplace = $row['birthplace'];
      $citizenship = $row['citizenship'];

    }
  }
  ?>

    <div class="container form-box">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Edit User Information
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
          else if ($_GET['error'] == "invalidusername") {
            echo '<div class="row form-group">
                    <div class="col-sm-12 text-center error">
                      Username is invalid
                    </div>
                  </div>';
          }
        }
      ?>

      <form role="form" method="post" action="includes/edit_user.inc.php">

        <div class="row">
          <label for="fname" class="col-sm-5 offset-sm-1">First Name:
            <input type="text" value="<?php echo empty($fname) ? "" : $fname; ?>" class="form-control" id="fname" name="fname">
          </label>
          <label for="mname" class="col-sm-5">Middle Name:
            <input type="text" value="<?php echo empty($mname) ? "" : $mname; ?>" class="form-control" id="mname" name="mname">
          </label>
        </div>

        <div class="row form-group">
          <label for="lname" class="col-sm-5 offset-sm-1">Last Name:
            <input type="text" value="<?php echo empty($lname) ? "" : $lname; ?>" class="form-control" id="lname" name="lname">
          </label>
          <label for="contactno" class="col-sm-5">Contact No.:
            <input type="text" value="<?php echo empty($contactno) ? "" : $contactno; ?>" min=0 class="form-control" id="contactno" name="contactno">
          </label>
        </div>

        <div class="row">
          <label for="birthdate" class="col-sm-5 offset-sm-1">Birth Date:
            <input type="date" value="<?php echo empty($birthdate) ? "" : $birthdate; ?>" class="form-control" id="birthdate" name="birthdate">
          </label>
          <label for="gender" class="col-sm-5" id="gender">Gender:
            <select class="form-control" name="gender">
              <option value="" disabled="true" <?php if ($gender == "") echo 'selected' ?> > -- Select an option -- </option>
              <option value="Male" <?php if ($gender == "Male") echo 'selected' ?> >Male</option>
              <option value="Female" <?php if ($gender == "Female") echo 'selected' ?> >Female</option>
            </select>
          </label>
        </div>

        <div class="row">
          <label for="address" class="col-sm-10 offset-sm-1">Address:
            <input type="text" value="<?php echo empty($address) ? "" : $address; ?>" class="form-control" id="address" name="address">
          </label>
        </div>

        <div class="row form-group">
          <label for="birthplace" class="col-sm-5 offset-sm-1">Place of birth (City):
            <input type="text" value="<?php echo empty($birthplace) ? "" : $birthplace; ?>" class="form-control" id="birthplace" name="birthplace">
          </label>
          <label for="citizenship" class="col-sm-5">Citizenship:
            <input type="text" value="<?php echo empty($citizenship) ? "" : $citizenship; ?>" class="form-control" id="citizenship" name="citizenship">
          </label>
        </div>

        <div class="row">
          <label for="user" class="col-sm-5 offset-sm-1">Username:
            <input type="text" value="<?php echo empty($_SESSION['username']) ? "" : $_SESSION['username']; ?>" class="form-control" id="user" name="user">
          </label>
        </div>

        <div class="row pt-sm-3">
          <div class="col-sm-4 offset-sm-4">
            <input type="submit" value="Submit" name="user_info_submit" class="btn btn-primary btn-block"/>
          </div>
        </div>
        <div class="row pt-sm-3">
          <a href='view_user.php' class="col-sm-2 offset-sm-5 btn btn-danger btn-block">
            Cancel
          </a>
        </div>

      </form>

    </div>
<?
  footertag();
?>
