
<?php
  require_once "template.php";
  headertag("View Student Transaction");


?>


    <div class="container form-box-md">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h4">
          <div>
            View Student Transaction
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
                FROM studtranstab
                WHERE studtransID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_GET['studid']);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
          $studtransID = $row['studtransID'];
          $acctinfoID = $row['acctinfoID'];
          $amountReceived = $row['amountReceived'];
          $dateReceived = $row['dateReceived'];
          $receiptNo = $row['receiptNo'];
          $modeOfPayment = $row['modeOfPayment'];
        }
        $sql = "SELECT *
                FROM acctinfotab
                WHERE acctinfoID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $acctinfoID);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
          $studID = $row['studID'];
          $paymentPlan = $row['paymentPlan'];
        }
        $sql = "SELECT *
                FROM studentinfotab
                WHERE studID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $studID);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
          $studentno = $row['studentno'];
          $lname = $row['lname'];
          $fname = $row['fname'];
          $mname = $row['mname'];
        }
      ?>
      <div id="incomestatement">

        <div class="row">
          <label class="col-sm-5 offset-sm-1">Date:
            <input readonly value="<?php echo $dateReceived; ?>" type="date" class="form-control col-sm-12" id="dateReceived" name="dateReceived">
          </label>
          <label class="col-sm-4">Receipt No.:
            <input readonly value="<?php echo empty($receiptNo) ? "" : $receiptNo; ?>" type="text" class="form-control col-sm-12" id="receiptNo" name="receiptNo">
          </label>
        </div>

        <hr/>

        <div class="row">
          <label class="col-sm-5 offset-sm-1">First Name:
            <input readonly value="<?php echo $fname; ?>" type="text" class="form-control col-sm-12" id="dateReceived" name="dateReceived">
          </label>
          <label class="col-sm-5">Middle Name:
            <input readonly value="<?php echo $mname; ?>" type="text" class="form-control col-sm-12" id="receiptNo" name="receiptNo">
          </label>
        </div>

        <div class="row">
          <label class="col-sm-5 offset-sm-1">Last Name:
            <input readonly value="<?php echo $lname; ?>" type="text" class="form-control col-sm-12" id="dateReceived" name="dateReceived">
          </label>
          <label class="col-sm-5">Student No.:
            <input readonly value="<?php echo $studentno; ?>" type="text" class="form-control col-sm-12" id="receiptNo" name="receiptNo">
          </label>
        </div>

        <div class="row">
          <label class="col-sm-5 offset-sm-1">Mode of Payment:
            <select disabled class="form-control" id="modeOfPayment" name="modeOfPayment">
              <option value="">-- Select an Option --</option>
              <option <?php if ($modeOfPayment == "Cash") echo 'selected' ?> value="Cash">Cash</option>
              <option <?php if ($modeOfPayment == "Credit") echo 'selected' ?> value="Credit">Credit</option>
              <option <?php if ($modeOfPayment == "Debit") echo 'selected' ?> value="Debit">Debit</option>
              <option <?php if ($modeOfPayment == "Check") echo 'selected' ?> value="Check">Check</option>
            </select>
          </label>
          <label class="col-sm-5">Amount Received:
            <input readonly value='<?php echo $amountReceived ?>' type="number" class="form-control col-sm-12" id="amountReceived" name="amountReceived">
          </label>
        </div>

      </div>

      <div class="row pt-sm-3">
        <a href='student_receipt.php?studid=<?php echo $studtransID?>' class="col-sm-2 offset-sm-5 btn btn-lg btn-primary btn-block">
          Print
        </a>
      </div>
      <div class="row pt-sm-3">
        <a href='<?php
        if($paymentPlan=="Installment"){
          echo "view_installment_list";
        }
        else if($paymentPlan=="Full Payment"){
          echo "view_payment_info";
        }
        ?>.php?acctid=<?php echo $acctinfoID?>' class="col-sm-2 offset-sm-5 btn btn-danger btn-block">
          Cancel
        </a>
      </div>

    </div>
<?
  footertag();
?>
