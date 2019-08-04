
<?php
  require_once "template.php";
  headertag("Add Installment");

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
          AND acctinfoID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $acctinfoID, $acctinfoID);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $remainingBalance = $row['remainingBalance'];
  }

  $sql = "SELECT receiptNo
          FROM studtranstab";
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
    $receiptNo = rand(100000, 999999);
    $arrlength = count($numberdump);
    for($x = 0; $x < $arrlength; $x++) {
      if($numberdump[$x] == $receiptNo){
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
        <div class="col-sm-12 text-center h4">
          <div>
            Add Installment
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

      <form method="post" action="includes/add_installment.inc.php?acctid=<?php echo $acctinfoID?>">

        <div class="row">
          <label class="col-sm-5 offset-sm-1">Date:
            <input readonly value="<?php echo date("Y-m-d"); ?>" type="date" class="form-control col-sm-12" id="dateReceived" name="dateReceived">
          </label>
          <label class="col-sm-4">Receipt No.:
            <input readonly value="<?php echo empty($receiptNo) ? "" : $receiptNo; ?>" type="text" class="form-control col-sm-12" id="receiptNo" name="receiptNo">
          </label>
        </div>

        <div class="row">
        </div>

        <hr/>

        <div class="row">
          <label class="col-sm-5 offset-sm-1">Remaining Balance:
            <input readonly value="<?php echo $remainingBalance ?>" type="number" class="form-control col-sm-12" id="remainingBalance" name="remainingBalance">
          </label>
        </div>

        <div class="row">
          <label class="col-sm-5 offset-sm-1">Mode of Payment:
            <select class="form-control" id="modeOfPayment" name="modeOfPayment">
              <option value="" disabled selected="selected">-- Select an Option --</option>
              <option value="Cash">Cash</option>
              <option value="Credit">Credit</option>
              <option value="Debit">Debit</option>
              <option value="Check">Check</option>
            </select>
          </label>
          <label class="col-sm-5">Amount Received:
            <input type="number" onchange="balance()" class="form-control col-sm-12" id="amountReceived" name="amountReceived" max="<?php echo $remainingBalance ?>">
          </label>
        </div>

        <div class="row">
        </div>

        <div class="row pt-sm-3">
          <div class="col-sm-4 offset-sm-4">
            <input type="submit" value="Submit" name="add_installment_submit" class="btn btn-primary btn-block"/>
          </div>
        </div>
        <div class="row pt-sm-3">
          <a href='view_installment_list.php?acctid=<?php echo $_GET['acctid']?>' class="col-sm-2 offset-sm-5 btn btn-danger btn-block">
            Cancel
          </a>
        </div>

      </form>

    </div>

    <script>
      function balance() {
        var x = document.getElementById("amountReceived").value;
        var y = <?php echo $remainingBalance ?>;

        y=y-x;
        document.getElementById("remainingBalance").value = y;
      }
    </script>
<?
  footertag();
?>
