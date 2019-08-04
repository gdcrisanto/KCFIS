
<?php
  require_once "template.php";
  headertag("Record Other Income");

  $sql = "SELECT ackReceiptNo
          FROM otherincometab";
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
            Record Other Income
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

      <form method="post" action="includes/add_other_income.inc.php">

        <div class="row">
          <label class="col-sm-5 offset-sm-1">Date:
            <input readonly value="<?php echo date("Y-m-d"); ?>" type="date" class="form-control col-sm-12" id="dateReceived" name="dateReceived">
          </label>
          <label class="col-sm-5">Receipt No.:
            <input readonly value="<?php echo $receiptNo ?>" type="text" class="form-control col-sm-12" id="ackReceiptNo" name="ackReceiptNo">
          </label>
        </div>

        <hr/>

        <div class="row">
          <label class="col-sm-10 offset-sm-1">Received From:
            <input type="text" class="form-control col-sm-12" name="receivedFrom" id="receivedFrom"/>
          </label>
        </div>

        <div class="row">
          <label class="col-sm-6 offset-sm-1">Amount:
            <input type="number" class="form-control col-sm-12" id="amount" name="amount" min="0">
          </label>
        </div>

        <div class="row pt-sm-3">
          <div class="col-sm-4 offset-sm-4">
            <input type="submit" value="Submit" name="add_other_income_submit" class="btn btn-primary btn-block"/>
          </div>
        </div>
        <div class="row pt-sm-3">
          <a href='other_income_list.php?' class="col-sm-2 offset-sm-5 btn btn-danger btn-block">
            Cancel
          </a>
        </div>

      </form>

    </div>
<?
  footertag();
?>
