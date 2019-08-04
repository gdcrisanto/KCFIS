
<?php
  require_once "template.php";
  headertag("View Staff Salary Statement");

  $stmt = $conn->prepare("SELECT *
                          FROM staffsalarystatementtab
                          WHERE staffsalarystateID = ?");
  $stmt->bind_param("s", $_GET['staffid']);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $staffID = $row['staffID'];
    $dateIssued = $row['dateIssued'];
    $grossIncome = $row['grossIncome'];
    $netIncome = $row['netIncome'];
    $monthlySalary = $row['monthlySalary'];
    $withholdingTax = $row['withholdingTax'];
    $overtimePays = $row['overtimePays'];
    $paidLeaves = $row['paidLeaves'];
    $adjustmentsAdd = $row['adjustmentsAdd'];
    $sss = $row['sss'];
    $philhealth = $row['philhealth'];
    $pagibig = $row['pagibig'];
    $personalLoans = $row['personalLoans'];
    $undertime = $row['undertime'];
    $absences = $row['absences'];
    $adjustmentsDeduc = $row['adjustmentsDeduc'];
  }

  $stmt = $conn->prepare("SELECT *
                          FROM staffinfotab
                          WHERE staffID = ?");
  $stmt->bind_param("s", $staffID);
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
          View Staff Salary Statement
        </div>
      </div>

      <form role="form" method="post" action="includes/add_staff_salary_statement.inc.php?staffid=<?php echo $_GET['staffid']?>">

        <div id="incomestatement">

          <div class="row">
            <label for="date" class="col-sm-3 offset-sm-1">Date Issued:
              <input readonly value="<?php echo date("Y-m-d"); ?>" type="date" class="form-control" id="date" name="date">
            </label>
          </div>

          <div class="row">
            <label for="fname" class="col-sm-5 offset-sm-1">First Name:
              <input readonly value="<?php echo $fname?>" type="text" class="form-control" id="fname" name="fname">
            </label>
            <label for="employeeID" class="col-sm-5">Employee ID:
              <input readonly value="<?php echo $employeeID?>" type="text" class="form-control" id="employeeID" name="employeeID">
            </label>
          </div>

          <div class="row">
            <label for="lname" class="col-sm-5 offset-sm-1">Last Name:
              <input readonly value="<?php echo $lname?>" type="text" class="form-control" id="lname" name="lname">
            </label>
            <label for="mname" class="col-sm-5">Middle Name:
              <input readonly value="<?php echo $mname?>" type="text" class="form-control" id="mname" name="mname">
            </label>
          </div>

          <div class="row form-group">
            <label class="col-sm-4 offset-sm-4">Monthly Salary:
              <input readonly value="<?php echo $monthlySalary?>" type="text" class="form-control" id="monthlySalary" name="monthlySalary"/>
            </label>
          </div>

          <hr />

          <div class="row form-group">
            <label class="col-sm-4 offset-sm-4 text-center h5">Additionals: </label>
          </div>

          <div class="row">
            <label for="overtime pays" class="col-sm-5 offset-sm-1">Overtime Pays:
              <input readonly value="<?php echo $overtimePays?>" type="number" class="form-control" id="overtimePays" name="overtimePays">
            </label>
            <label for="paid leaves" class="col-sm-5">Paid Leaves:
              <input readonly value="<?php echo $paidLeaves?>" type="number" class="form-control" id="paidLeaves" name="paidLeaves">
            </label>
          </div>

          <div class="row form-group">
            <label for="adjustments" class="col-sm-5 offset-sm-1">Adjustments:
              <input readonly value="<?php echo $adjustmentsAdd?>" type="number" class="form-control" id="adjustmentsAdd" name="adjustmentsAdd">
            </label>
          </div>

          <div class="row form-group">
            <label class="col-sm-4 offset-sm-4">Gross Income:
              <input readonly value="<?php echo $grossIncome?>" type="text" class="form-control" id="grossIncome" name="grossIncome"/>
            </label>
          </div>

          <hr />

          <div class="row form-group">
            <label class="col-sm-4 offset-sm-4 text-center h5">Deductions: </label>
          </div>

          <div class="row">
            <label for="sss" class="col-sm-5 offset-sm-1">SSS:
              <input readonly value="<?php echo $sss?>"t type="number" class="form-control" id="sss" name="sss">
            </label>
            <label for="philhealth" class="col-sm-5">Philhealth:
              <input readonly value="<?php echo $philhealth?>" type="number" class="form-control" id="philhealth" name="philhealth">
            </label>
          </div>

          <div class="row">
            <label for="pagibig" class="col-sm-5 offset-sm-1">Pag-ibig:
              <input readonly value="<?php echo $pagibig?>" type="number" class="form-control" id="pagibig" name="pagibig">
            </label>
            <label for="personalLoans" class="col-sm-5">Personal Loans:
              <input readonly value="<?php echo $personalLoans?>" type="number" class="form-control" id="personalLoans" name="personalLoans">
            </label>
          </div>

          <div class="row">
            <label for="undertime" class="col-sm-5 offset-sm-1">Undertime:
              <input readonly value="<?php echo $undertime?>" type="number" class="form-control" id="undertime" name="undertime">
            </label>
            <label for="absences" class="col-sm-5">Absences:
              <input readonly value="<?php echo $absences?>" type="number" class="form-control" id="absences" name="absences">
            </label>
          </div>

          <div class="row form-group">
            <label for="withholdingTax" class="col-sm-5 offset-sm-1">Withholding Tax:
              <input readonly value="<?php echo $withholdingTax?>" type="number" class="form-control" id="withholdingTax" name="withholdingTax">
            </label>
            <label for="adjustments" class="col-sm-5">Adjustments:
              <input readonly value="<?php echo $adjustmentsDeduc?>" type="number" class="form-control" id="adjustmentsDeduc" name="adjustmentsDeduc">
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
            <a href="staff_salstatement_list.php" class="btn btn-secondary">Return to List</a>
          </div>
        </div>

      </form>

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

<?
  footertag();
?>
