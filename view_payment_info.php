
<?php
  require_once "template.php";
  require_once "functions.php";
  headertag("Account Information");
  $sql = "SELECT *
          FROM studtranstab
          WHERE acctinfoID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $_GET['acctid']);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $acctinfoID = $row['acctinfoID'];
  }
  $sql = "SELECT remainingBalance
          FROM studtranstab
          WHERE dateReceived = (SELECT max(dateReceived) FROM studtranstab WHERE acctinfoID = ?)
          AND acctinfoID = ? ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $acctinfoID, $acctinfoID);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $remainingBalance = $row['remainingBalance'];
  }

  $sql = "SELECT studID
          FROM acctinfotab
          WHERE acctinfoID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $acctinfoID);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $studID = $row['studID'];
    // $dateReceived = $row['dateReceived'];
  }
?>


    <div class="container form-box-md">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Account Information
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

      <div class="row">
        <label class="col-sm-4 offset-sm-1">
          Current Balance:
          <input readonly type="text" class="form-control col-sm-12" value="<?php echo empty($remainingBalance) ? "Payment Settled" : $remainingBalance; ?>" name="balance"/>
        </label>
      </div>

      <div class="row">
        <label class="col-sm-10 offset-sm-1">
          Payment History:
          <table class="table table-hover">
            <thead class="thead-light">
              <tr>
                <th scope="col">Receipt No.</th>
                <th scope="col">Amount</th>
                <th scope="col">Date Received</th>
              </tr>
            </thead>
            <tbody>
              <?php
              fullpaymentlist($acctinfoID);
              ?>
            </tbody>
          </table>
        </label>
      </div>

      <?php
      if (($remainingBalance != 0) && ($_SESSION['usertype'])=='Cashier'){
        ?>
        <div class="row form-group">
          <div class="col-sm-6 offset-sm-3">
            <a href="add_fullpayment.php?acctid=<?php echo $acctinfoID ?>" class="btn btn-block btn-primary btn-lg">Record Payment</a>
          </div>
        </div>
        <?php
      }
      ?>
      <?php
      if ($_SESSION['usertype']=='Cashier'){
        ?>
        <div class="row form-group">
          <div class="col-sm-6 offset-sm-3">
            <a href="student_acct_list.php?studid=<?php echo $studID ?>" class="btn btn-block btn-secondary">List of Student Accounts</a>
          </div>
        </div>
        <?php
      }
      ?>
      <?php
      if ($_SESSION['usertype']=='Accounting Supervisor'){
        ?>
        <div class="row form-group">
        <div class="col-sm-6 offset-sm-3">
          <a href="outstanding_balances.php" class="btn btn-block btn-secondary">List of Outstanding Balances</a>
        </div>
      </div>
        <?php
      }
      ?>


    </div>
<?php
  footertag();
?>
