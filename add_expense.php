
<?php
  require_once "template.php";
  headertag("Record Expense");

?>


    <div class="container form-box-md">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h4">
          <div>
            Record Expense
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

      <form method="post" action="includes/add_expense.inc.php">

        <div class="row">
          <label class="col-sm-5 offset-sm-1">Date:
            <input readonly value="<?php echo date("Y-m-d"); ?>" type="date" class="form-control col-sm-12" id="datePurchased" name="datePurchased">
          </label>
        </div>

        <div class="row">
          <label class="col-sm-6 offset-sm-1">Type of Expense:
            <select class="form-control" name="expenseType">
              <option value="" disabled="true" selected="selected"> -- Select an option -- </option>
              <option value="Communication">Communication</option>
              <option value="Fuel and Oil">Fuel and Oil</option>
              <option value="Light and Water">Light and Water</option>
              <option value="Office Supplies">Office Supplies</option>
              <option value="Rentals">Rentals</option>
              <option value="Taxes and Licenses">Taxes and Licenses</option>
              <option value="Representations">Representations</option>
              <option value="Professional Fees">Professional Fees</option>
              <option value="Salaries and Allowances">Salaries and Allowances</option>
              <option value="Transportation Allowances">Transportation Allowances</option>
              <option value="Miscellaneous Expenses">Miscellaneous Expenses</option>
            </select>
          </label>
          <label class="col-sm-4">Amount:
            <input type="number" min="0" class="form-control col-sm-12" id="amount" name="amount">
          </label>
        </div>

        <div class="row">
          <label class="col-sm-10 offset-sm-1">Remarks:
            <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
          </label>
        </div>

        <div class="row pt-sm-3">
          <div class="col-sm-4 offset-sm-4">
            <input type="submit" value="Submit" name="add_expense_submit" class="btn btn-primary btn-block"/>
          </div>
        </div>

      </form>

    </div>
<?
  footertag();
?>
