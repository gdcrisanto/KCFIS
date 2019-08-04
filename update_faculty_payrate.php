
<?php
  require_once "template.php";
  headertag("Faculty Pay Rate Information");
  require 'includes/db.inc.php';

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
  $sql = "SELECT hourlyRate
          FROM facultyratetab
          WHERE dateUpdated = (SELECT max(dateUpdated) FROM facultyratetab WHERE facID = ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $facID);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $hourlyRate = $row['hourlyRate'];
  }
?>


    <div class="container form-box-md">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h4">
          <div>
            Pay Rate Information <br />
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

      <form method="post" action="includes/update_faculty_payrate.inc.php?facid=<?php echo $facID ?>">

        <div class="row">
          <label for="fname" class="col-sm-6 offset-sm-1">New Hourly Rate:
            <input value="<?php echo empty($hourlyRate) ? "" : $hourlyRate; ?>" type="number" class="form-control col-sm-12" id="hourlyRate" name="hourlyRate" min="0">
          </label>
          <label for="fname" class="col-sm-4">Date:
            <input readonly value="<?php echo date("Y-m-d"); ?>" type="date" class="form-control col-sm-12" id="dateUpdated" name="dateUpdated">
          </label>
        </div>

        <div class="row pt-sm-3">
          <div class="col-sm-4 offset-sm-4">
            <input type="submit" value="Submit" name="faculty_payrate_submit" class="btn btn-primary btn-block"/>
          </div>
        </div>
        <div class="row pt-sm-3">
          <a href='faculty_payrate_info.php?facid=<?php echo $facID?>' class="col-sm-2 offset-sm-5 btn btn-danger btn-block">
            Cancel
          </a>
        </div>

      </form>

    </div>
<?
  footertag();
?>
