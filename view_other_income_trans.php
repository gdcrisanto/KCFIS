
<?php
  require_once "template.php";
  headertag("View Other Income Transaction");


?>


    <div class="container form-box-md">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h4">
          <div>
            View Other Income Transaction
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

        $sql = "SELECT *
                FROM otherincometab
                WHERE otherIncomeID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_GET['oiid']);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
          $otherIncomeID = $row['otherIncomeID'];
          $amount = $row['amount'];
          $dateReceived = $row['dateReceived'];
          $receivedFrom = $row['receivedFrom'];
          $ackReceiptNo = $row['ackReceiptNo'];
        }
      ?>
      <div id="incomestatement">

        <div class="row">
          <label class="col-sm-5 offset-sm-1">Date:
            <input readonly value="<?php echo $dateReceived; ?>" type="date" class="form-control col-sm-12" id="dateReceived" name="dateReceived">
          </label>
          <label class="col-sm-5">Receipt No.:
            <input readonly value="<?php echo empty($ackReceiptNo) ? "" : $ackReceiptNo; ?>" type="text" class="form-control col-sm-12" id="receiptNo" name="receiptNo">
          </label>
        </div>

        <hr/>

        <div class="row">
          <label class="col-sm-10 offset-sm-1">Received From:
            <input readonly value="<?php echo $receivedFrom; ?>" type="text" class="form-control col-sm-12" id="dateReceived" name="dateReceived">
          </label>
        </div>

        <div class="row">
          <label class="col-sm-6 offset-sm-3">Amount Received:
            <input readonly value='<?php echo $amount ?>' type="number" class="form-control col-sm-12" id="amountReceived" name="amountReceived">
          </label>
        </div>

      </div>

      <div class="row pt-sm-3">
        <a href='other_income_receipt.php?oiid=<?php echo $otherIncomeID?>' class="col-sm-2 offset-sm-5 btn btn-lg btn-primary btn-block"/>
          Print
        </a>
      </div>
      <div class="row pt-sm-3">
        <a href='other_income_list.php' class="col-sm-2 offset-sm-5 btn btn-danger btn-block">
          Cancel
        </a>
      </div>

    </div>

<?
  footertag();
?>
