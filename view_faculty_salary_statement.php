
<?php
  require_once "template.php";
  headertag("View Faculty Salary Statement");


  $stmt = $conn->prepare("SELECT *
                          FROM facsalarystatementtab
                          WHERE facsalarystatementID = ?");
  $stmt->bind_param("s", $_GET['facid']);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $dateIssued = $row['dateIssued'];
    $hourlyRate = $row['hourlyRate'];
    $hoursWorked = $row['hoursWorked'];
    $grossIncome = $row['grossIncome'];
    $withholdingTax = $row['withholdingTax'];
    $netIncome = $row['netIncome'];
    $facID = $row['facID'];
  }

  $stmt = $conn->prepare("SELECT *
    FROM facultyinfotab
    WHERE facID = ?");
    $stmt->bind_param("s", $facID);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
      $fname = $row['fname'];
      $mname = $row['mname'];
      $lname = $row['lname'];
      $employeeID = $row['employeeID'];
    }
?>


    <div class="container form-box">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Faculty Salary Statement
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

      <form role="form" method="post" action="includes/add_faculty_salary_statement.inc.php?facid=<?php echo $_GET['facid']?>">

        <div id='incomestatement'>

          <div class="row">
            <label for="date" class="col-sm-3 offset-sm-1">Date Issued:
              <input readonly value="<?php echo $dateIssued ?>" type="date" class="form-control" id="dateIssued" name="dateIssued">
            </label>
          </div>

          <div class="row">
            <label for="fname" class="col-sm-5 offset-sm-1">First Name:
              <input readonly value="<?php echo $fname?>" type="text" class="form-control" id="fname" name="fname">
            </label>
            <label for="employeeID" class="col-sm-5">Employee ID:
              <input readonly value="<?php echo $employeeID?>"type="text" class="form-control" id="employeeID" name="employeeID">
            </label>
          </div>

          <div class="row">
            <label for="lname" class="col-sm-5 offset-sm-1">Last Name:
              <input readonly value="<?php echo $lname?>"type="text" class="form-control" id="lname" name="lname">
            </label>
            <label for="mname" class="col-sm-5">Middle Name:
              <input readonly value="<?php echo $mname?>"type="text" class="form-control" id="mname" name="mname">
            </label>
          </div>

          <hr />

          <div class="row">
            <label class="col-sm-5 offset-sm-1">Current Pay Rate:
              <input readonly value="<?php echo $hourlyRate?>"type="text" class="form-control" id="hourlyRate" name="hourlyRate">
            </label>
            <label class="col-sm-5">Total Hours:
              <input readonly value="<?php echo $hoursWorked?>" type="number" class="form-control" id="hoursWorked" name="hoursWorked">
            </label>
          </div>

          <div class="row">
            <label class="col-sm-5 offset-sm-1">Gross Income:
              <input readonly value="<?php echo $grossIncome?>" type="text" class="form-control" id="grossIncome" name="grossIncome">
            </label>
            <label class="col-sm-5">Withholding Tax (10%):
              <input readonly value="<?php echo $withholdingTax?>" type="text" class="form-control" id="withholdingTax" name="withholdingTax">
            </label>
          </div>

          <div class="row form-group">
            <label class="col-sm-4 offset-sm-4">Net Income:
              <input readonly value="<?php echo $netIncome?>" type="text" class="form-control" id="netIncome" name="netIncome"/>
            </label>
          </div>

        </div>

        <div class="row pt-sm-3">
          <label class="col-sm-2 offset-sm-5 btn btn-primary btn-lg btn-block" onclick="printlayer('incomestatement')">Print</label>
        </div>

        <div class="row">
          <div class="col-sm-4 offset-sm-4 text-center">
            <a href="faculty_salstatement_list.php" class="btn btn-secondary">Return to List</a>
          </div>
        </div>

      </form>

    </div>

    <script>
      function compute() {
        var hourlyRate = document.getElementById("hourlyRate").value;
        var hoursWorked = document.getElementById("hoursWorked").value;
        var grossIncome;
        var withholdingTax;
        var netIncome;

        grossIncome = hourlyRate*hoursWorked;
        withholdingTax = grossIncome*0.1;
        netIncome = grossIncome - withholdingTax;
        document.getElementById("grossIncome").value = grossIncome;
        document.getElementById("withholdingTax").value = withholdingTax;
        document.getElementById("netIncome").value = netIncome;

      }
      element = document.getElementById("balance")
      element.addEventListener("input", difference)

      function printlayer(layer){
        var restorepage = document.body.innerHTML;
        var layertext = document.getElementById(layer).innerHTML;
        document.body.innerHTML = layertext;
        window.print();
        document.body.innerHTML = restorepage;
      }
    </script>
<?
  footertag();
?>
