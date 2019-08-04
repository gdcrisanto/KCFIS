
<?php
  require_once "template.php";
  headertag("Staff Salary Information");
  require 'includes/db.inc.php';

  $sql = "SELECT *
          FROM staffinfotab
          WHERE staffID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $_GET['staffid']);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $staffID = $row['staffID'];
    $lname = $row['lname'];
    $fname = $row['fname'];
  }
  $sql = "SELECT monthlySalary
          FROM staffsalarytab
          WHERE dateUpdated = (SELECT max(dateUpdated) FROM staffsalarytab WHERE staffID = ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $staffID);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $monthlySalary = $row['monthlySalary'];
  }
?>


    <div class="container form-box-md">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h4">
          <div>
            Salary Information <br />
            of <?php echo $fname." ".$lname ?>
          </div>
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

      <form method="post" action="includes/update_staff_salary.inc.php?staffid=<?php echo $staffID ?>">

        <div class="row">
          <label for="fname" class="col-sm-6 offset-sm-1">New Monthly Salary:
            <input value="<?php echo empty($monthlySalary) ? "" : $monthlySalary; ?>" placeholder="" type="text" class="form-control col-sm-12" id="monthlySalary" name="monthlySalary">
          </label>
          <label for="fname" class="col-sm-4">Date:
            <input readonly value="<?php echo date("Y-m-d"); ?>" type="date" class="form-control col-sm-12" id="dateUpdated" name="dateUpdated">
          </label>
        </div>

        <div class="row pt-sm-3">
          <div class="col-sm-4 offset-sm-4">
            <input type="submit" value="Submit" name="staff_salary_submit" class="btn btn-primary btn-block"/>
          </div>
        </div>
        <div class="row pt-sm-3">
          <a href='staff_salary_info.php?staffid=<?php echo $staffID?>' class="col-sm-2 offset-sm-5 btn btn-danger btn-block">
            Cancel
          </a>
        </div>

      </form>

    </div>
<?
  footertag();
?>
