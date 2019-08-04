
<?php
  require_once "template.php";
  headertag("View Faculty Information");
?>


    <div class="container form-box">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Faculty Information
        </div>
      </div>

      <?php
      require 'includes/db.inc.php';
        if (isset($_GET['error'])) {
          if ($_GET['error'] == "emptyfields") {
            echo '<div class="row form-group">
                    <div class="col-sm-12 text-center error">
                      Fill up all fields
                    </div>
                  </div>';
          }
        }

        $sql = "SELECT *
                FROM facultyinfotab
                WHERE facID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_GET['facid']);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
          $facID = $row['facID'];
          $employeeID = $row['employeeID'];
          $lname = $row['lname'];
          $fname = $row['fname'];
          $mname = $row['mname'];
          $contactno = $row['contactno'];
          $address = $row['address'];
        }
      ?>

      <div class="row">
        <label for="employeeID" class="col-sm-5 offset-sm-1">Employee ID:
          <input disabled value="<?php echo empty($employeeID) ? "" : $employeeID; ?>" type="text" class="form-control" id="employeeID" name="employeeID">
        </label>
      </div>

      <div class="row">
        <label for="fname" class="col-sm-5 offset-sm-1">First Name:
          <input disabled value="<?php echo empty($fname) ? "" : $fname; ?>" type="text" class="form-control" id="fname" name="fname">
        </label>
        <label for="mname" class="col-sm-5">Middle Name:
          <input disabled value="<?php echo empty($mname) ? "" : $mname; ?>" type="text" class="form-control" id="mname" name="mname">
        </label>
      </div>

      <div class="row">
        <label for="lname" class="col-sm-5 offset-sm-1">Last Name:
          <input disabled value="<?php echo empty($lname) ? "" : $lname; ?>" type="text" class="form-control" id="lname" name="lname">
        </label>
        <label for="contactno" class="col-sm-5">Contact No.:
          <input disabled value="<?php echo empty($contactno) ? "" : $contactno; ?>" type="text" class="form-control" id="contactno" name="contactno">
        </label>
      </div>

      <div class="row form-group">
        <label for="address" class="col-sm-10 offset-sm-1">Address:
          <input disabled value="<?php echo empty($address) ? "" : $address; ?>" type="text" class="form-control" id="address" name="address">
        </label>
      </div>

      <div class="row form-group">
        <div class="col-sm-4 offset-sm-4">
          <input type="submit" onclick="document.location='faculty_payrate_info.php?facid=<?php echo $facID ?>'" value="View Pay Rate Info" name="staffid" class="btn btn-primary btn-block"/>
        </div>
        <?php
          if ($_SESSION['usertype']=='Data Encoder'){
            ?>
            <div class="col-sm-2">
              <input type="submit" onclick="document.location='edit_faculty.php?facid=<?php echo $facID ?>'" value="Edit" name="staffid" class="btn btn-primary btn-block"/>
            </div>
            <?php
          }
        ?>
      </div>
      <div class="row">
        <div class="col-sm-2 offset-sm-5">
          <input type="submit" onclick="document.location='search_faculty.php'" value="Back to List" name="studid" class="btn btn-secondary btn-block  "/>
        </div>
      </div>
    </div>
<?
  footertag();
?>
