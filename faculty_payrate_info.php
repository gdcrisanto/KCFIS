
<?php
  require_once "template.php";
  headertag("Faculty Pay Rate Information");
  require 'includes/db.inc.php';
  require 'functions.php';

  $sql = "SELECT *
          FROM facultyinfotab
          WHERE facID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $_GET['facid']);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $facID = $row['facID'];
    $lname = $row['lname'];
    $fname = $row['fname'];
  }
  $sql = "SELECT hourlyRate, dateUpdated
          FROM facultyratetab
          WHERE dateUpdated = (SELECT max(dateUpdated) FROM facultyratetab WHERE facID = ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $facID);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $hourlyRate = $row['hourlyRate'];
    $dateUpdated = $row['dateUpdated'];
  }
?>


    <div class="container form-box-md">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Pay Rate Information of <?php echo $fname." ".$lname ?>
        </div>
      </div>


      <div class="row">
        <label for="fname" class="col-sm-4 offset-sm-1">Current Hourly Rate:
          <input readonly value="<?php echo empty($hourlyRate) ? "None" : $hourlyRate; ?>" type="text" class="form-control col-sm-12" id="hourlyRate" name="hourlyRate">
        </label>
        <label for="mname" class="col-sm-6">Salary History:
          <table class="table table-hover table-sm">
            <thead class="thead-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Hourly Rate</th>
                <th scope="col">Date Updated</th>
              </tr>
            </thead>
            <tbody>
              <?php
                payratelist($facID);
              ?>
            </tbody>
          </table>
        </label>
      </div>

      <div class="row pt-sm-3">
        <div class="col-sm-4 offset-sm-4">
          <input type="submit" onclick="document.location='update_faculty_payrate.php?facid=<?php echo $facID ?>'" value="Update Pay Rate" name="facid" class="btn btn-primary btn-block"/>
        </div>
      </div>

    </div>
<?
  footertag();
?>
