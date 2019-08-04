
<?php
  require_once "template.php";
  headertag("Add Student Account");
  require 'includes/db.inc.php';

  $studID = $_GET['studid'];
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM studentinfotab
          WHERE studID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $studID);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $studID = $row['studID'];
    $lname = $row['lname'];
    $fname = $row['fname'];
  }

  $sql = "SELECT acctno
          FROM acctinfotab";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  $numberdump = [];
  while($row = $result->fetch_assoc()){
    $numberdump[] = $row;
  }
  $unique=0;
  while($unique==0){
    $count = 0;
    $acctno = rand(100000, 999999);
    $arrlength = count($numberdump);
    for($x = 0; $x < $arrlength; $x++) {
      if($numberdump[$x] == $acctno){
        $count = $count + 1;
        break;
      }
    }
    if($count < 1){
      $unique = 1;
    }
  }
?>


    <div class="container form-box-md">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          <div>
            Add Account <br />
            for <?php echo $fname." ".$lname ?>
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

      <form method="post" action="includes/add_student_acct.inc.php?studid=<?php echo $studID ?>">

        <div class="row">
          <label class="col-sm-3 offset-sm-1">Account No.:
            <input readonly value="<?php echo empty($acctno) ? "" : $acctno; ?>" type="text" class="form-control col-sm-12" id="acctno" name="acctno">
          </label>
          <label class="col-sm-4">Date:
            <input readonly value="<?php echo date("Y-m-d"); ?>" type="date" class="form-control col-sm-12" id="dateUpdated" name="dateUpdated">
          </label>
          <label class="col-sm-3">Semester:
            <select class="form-control" name="semester">
              <option value="" disabled="true" selected="selected"> - Select - </option>
              <option value="1st">1st</option>
              <option value="2nd">2nd</option>
            </select>
          </label>
        </div>

        <div class="row">
          <label class="col-sm-5 offset-sm-1">Payment Plan:
            <select class="form-control" name="paymentPlan">
              <option value="" disabled="true" selected="selected"> -- Select an option -- </option>
              <option value="Installment">Installment</option>
              <option value="Full Payment">Full Payment</option>
            </select>
          </label>
          <label class="col-sm-5">Balance:
            <input type="number" class="form-control col-sm-12" id="remainingBalance" name="remainingBalance">
          </label>
        </div>

        <div class="row pt-sm-3">
          <div class="col-sm-4 offset-sm-4">
            <input type="submit" value="Submit" name="student_acct_submit" class="btn btn-primary btn-block"/>
          </div>
        </div>
        <div class="row pt-sm-3">
          <a href='student_acct_list.php?studid=<?php echo $studID?>' class="col-sm-2 offset-sm-5 btn btn-danger btn-block">
            Cancel
          </a>
        </div>

      </form>

    </div>
<?
  footertag();
?>
