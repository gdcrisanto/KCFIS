
<?php
  require_once "template.php";
  headertag("Staff Salary Information");
  require 'includes/db.inc.php';
  require 'functions.php';

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
  $sql = "SELECT monthlySalary, dateUpdated
          FROM staffsalarytab
          WHERE dateUpdated = (SELECT max(dateUpdated) FROM staffsalarytab WHERE staffID = ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $staffID);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $monthlySalary = $row['monthlySalary'];
    $dateUpdated = $row['dateUpdated'];
  }
?>

    <div class="container form-box-md">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Salary Information of <?php echo $fname." ".$lname ?>
        </div>
      </div>

      <div class="row">
        <label for="fname" class="col-sm-4 offset-sm-1">Current Monthly Salary:
          <input readonly value="<?php echo empty($monthlySalary) ? "None" : $monthlySalary; ?>" type="text" class="form-control col-sm-12" id="monthlySalary" name="monthlySalary">
        </label>
        <label for="mname" class="col-sm-6">Salary History:
          <table class="table table-hover table-sm">
            <thead class="thead-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Monthly Salary</th>
                <th scope="col">Date Updated</th>
              </tr>
            </thead>
            <tbody>
              <?php
                salarylist($staffID);
              ?>
            </tbody>
          </table>
        </label>
      </div>

      <div class="row pt-sm-3">
        <div class="col-sm-4 offset-sm-4">
          <input type="submit" onclick="document.location='update_staff_salary.php?staffid=<?php echo $staffID ?>'" value="Update Salary" name="staffid" class="btn btn-primary btn-block"/>
        </div>
      </div>

    </div>
<?
  footertag();
?>
