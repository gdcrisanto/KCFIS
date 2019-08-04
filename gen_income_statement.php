
<?php
  require_once "template.php";
  require_once "functions.php";
  headertag("Generate Income Statement");


?>


    <div class="container form-box">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Generate Income Statement
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
        if (isset($_POST['dateStart']) || isset($_POST['dateEnd'])) {
          $tuitionIncome = 0;
          $otherIncome = 0;
          $salaryExpense = 0;
          $otherExpense = 0;
          $totalRevenue = 0;
          $totalExpense = 0;
          $totalIncome = 0;

          $sql = "SELECT amountReceived
                  FROM studtranstab
                  WHERE dateReceived
                  between ? and LAST_DAY(?)";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("ss", $_POST['dateStart'], $_POST['dateEnd']);
          $stmt->execute();
          $result = $stmt->get_result();
          while($row = $result->fetch_assoc()){
            if ($row['amountReceived'] > 0){
              $amountReceived = $row['amountReceived'];
              $tuitionIncome = $tuitionIncome + $amountReceived;
            }
          }
          $sql = "SELECT amount
                  FROM otherincometab
                  WHERE dateReceived
                  between ? and LAST_DAY(?)";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("ss", $_POST['dateStart'], $_POST['dateEnd']);
          $stmt->execute();
          $result = $stmt->get_result();
          while($row = $result->fetch_assoc()){
            if ($row['amount'] > 0){
              $amount = $row['amount'];
              $otherIncome = $otherIncome + $amount;
            }
          }
          $sql = "SELECT amount
                  FROM expensetab
                  WHERE datePurchased
                  between ? and LAST_DAY(?)";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("ss", $_POST['dateStart'], $_POST['dateEnd']);
          $stmt->execute();
          $result = $stmt->get_result();
          while($row = $result->fetch_assoc()){
            if ($row['amount'] > 0){
              $amount = $row['amount'];
              $otherExpense = $otherExpense + $amount;
            }
          }
          $sql = "SELECT netIncome
                  FROM staffsalarystatementtab
                  WHERE dateIssued
                  between ? and LAST_DAY(?)";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("ss", $_POST['dateStart'], $_POST['dateEnd']);
          $stmt->execute();
          $result = $stmt->get_result();
          while($row = $result->fetch_assoc()){
            if ($row['netIncome'] > 0){
              $netIncome = $row['netIncome'];
              $salaryExpense = $salaryExpense + $netIncome;
            }
          }
          $sql = "SELECT netIncome
                  FROM facsalarystatementtab
                  WHERE dateIssued
                  between ? and LAST_DAY(?)";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("ss", $_POST['dateStart'], $_POST['dateEnd']);
          $stmt->execute();
          $result = $stmt->get_result();
          while($row = $result->fetch_assoc()){
            if ($row['netIncome'] > 0){
              $netIncome = $row['netIncome'];
              $salaryExpense = $salaryExpense + $netIncome;
            }
          }
          $totalRevenue = $tuitionIncome + $otherIncome;
          $totalExpense = $salaryExpense + $otherExpense;
          $totalIncome = $totalRevenue - $totalExpense;
        }
      ?>

      <form role="form" method="post" action="gen_income_statement.php">

            <div class="container" id="incomestatement">

              <div class="row form-group">
                <label class="col-sm-4 offset-sm-2">
                  Start Date:
                  <input value="<?php if (isset($_POST['dateStart'])) {
                    echo $_POST['dateStart'];
                  }?>" palceholder="Start Date" type="date" class="form-control" name="dateStart"/>
                </label>
                <label class="col-sm-4">
                  End Date:
                  <input type="date" value="<?php if (isset($_POST['dateEnd'])){
                    echo $_POST['dateEnd'];
                  }
                  else {
                    echo date("Y-m-d");
                  }?>" class="form-control" name="dateEnd"/>
                </label>
              </div>
              <div class="row form-group">
                <div class="col-sm-4 offset-sm-4">
                  <input type="submit" value="Generate" class="col-sm-8 offset-sm-2 btn btn-primary btn-block"/>
                </div>
              </div>
            </form>

            <hr />

            <?php
            if (isset($_POST['dateStart']) || isset($_POST['dateEnd'])) {
              ?>
              <form role="form" method="post" action="includes/gen_income_statement.inc.php">
                <input hidden name="dateStart" type="date" value="<?php echo $_POST['dateStart'] ?>" />
                <input hidden name="dateEnd" type="date" value="<?php echo $_POST['dateEnd'] ?>" />
                <div class="row form-group">
                  <label class="col-sm-4 offset-sm-4 h6">
                    Date Created:
                    <input readonly type="date" value="<?php echo date("Y-m-d"); ?>" class="form-control" name="dateCreated"/>
                  </label>
                </div>
                <div class="col-sm-10 offset-sm-1">
                  <div class="row form-group">
                    <label class="col-sm-4 offset-sm-4 text-center h5">Revenue: </label>
                  </div>

                  <table class="table table-hover">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Type of Income</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Total of Tuitions Fees Paid</td>
                        <td>PHP <?php echo $tuitionIncome ?></td>
                      </tr>
                      <tr>
                        <td>Total of Other Income</td>
                        <td>PHP <?php echo $otherIncome ?></td>
                      </tr>
                    </tbody>
                  </table>

                  <div class="row form-group">
                    <label class="col-sm-8 offset-sm-2 text-center h6">
                      Total Revenue:
                      <input readonly value="<?php echo $totalRevenue?>" type="number" step="0.01"class="form-control col-sm-6 offset-sm-3" name="totalRevenue"/>
                    </label>
                  </div>
                </div>

                <hr />

                <div class="col-sm-10 offset-sm-1">
                  <div class="row form-group">
                    <label class="col-sm-4 offset-sm-4 text-center h5">Expenses: </label>
                  </div>

                  <table class="table table-hover">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Type of Expense</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Total of Employee Salaries Paid</td>
                        <td>PHP <?php echo $salaryExpense ?></td>
                      </tr>
                      <tr>
                        <td>Total of School Expenses</td>
                        <td>PHP <?php echo $otherExpense ?></td>
                      </tr>
                    </tbody>
                  </table>

                  <div class="row form-group">
                    <label class="col-sm-8 offset-sm-2 text-center h6">
                      Total Expense:
                      <input readonly value="<?php echo $totalExpense?>" type="number" step="0.01" class="form-control col-sm-6 offset-sm-3" name="totalExpense"/>
                    </label>
                  </div>
                </div>

                <div class="row form-group mt-sm-5">
                  <label class="col-sm-4 offset-sm-4 text-center h6">
                    Net Income:
                    <input readonly value="<?php echo $totalIncome?>" type="number" step="0.01" class="form-control col-sm-6 offset-sm-3" name="totalIncome"/>
                  </label>
                </div>

            </div>

            <hr />

            <div class="row form-group">
              <div class="col-sm-4 offset-sm-3">
                <input type="submit" value="Submit" name="gen_income_statement" class="btn btn-primary btn-block"/>
              </div>
              <label class="col-sm-2 btn btn-primary btn-block" onclick="printlayer('incomestatement')">Print</label>
            </div>
          </form>
          <?php
        }
      ?>
      <div class="row form-group">
        <a href='income_statement_list.php' class="col-sm-2 offset-sm-5 btn btn-danger btn-block"/>
          Cancel
        </a>
      </div>


    </div>
    <script>
      function printlayer(layer){
        var restorepage = document.body.innerHTML;
        var layertext = document.getElementById(layer).innerHTML;
        document.body.innerHTML = layertext;
        window.print();
        document.body.innerHTML = restorepage;
      }
    </script>
<?php
  footertag();
?>
