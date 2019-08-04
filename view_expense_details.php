
<?php
  require_once "template.php";
  headertag("View Expense Details");

  $expenseID = $_GET['expnsid'];
  $sql = "SELECT *
          FROM expensetab
          WHERE expenseID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i",$expenseID);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $expenseID = $row['expenseID'];
    $expenseType = $row['expenseType'];
    $datePurchased = $row['datePurchased'];
    $amount = $row['amount'];
    $remarks = $row['remarks'];
  }
?>


    <div class="container form-box-md">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h4">
          <div>
            View Expense Details
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

      <div class="row">
        <label class="col-sm-5 offset-sm-1">Date:
          <input disabled value="<?php echo $datePurchased ?>" type="date" class="form-control col-sm-12" id="datePurchased" name="datePurchased">
        </label>
      </div>

      <div class="row">
        <label class="col-sm-6 offset-sm-1">Type of Expense:
          <input disabled type="text" value="<?php echo $expenseType ?>" class="form-control" name="expenseType">
        </label>
        <label class="col-sm-4">Amount:
          <input disabled value="<?php echo $amount ?>" type="text" class="form-control col-sm-12" id="amount" name="amount">
        </label>
      </div>

      <div class="row">
        <label class="col-sm-10 offset-sm-1">Remarks:
          <textarea disabled class="form-control" id="remarks" name="remarks" rows="3"><?php echo $remarks ?></textarea>
        </label>
      </div>

      <div class="row pt-sm-3">
        <div class="col-sm-4 offset-sm-4">
          <input type="submit" onclick="document.location='expenses_list.php'" value="Return to list" class="btn btn-primary btn-block"/>
        </div>
      </div>

    </div>
<?
  footertag();
?>
