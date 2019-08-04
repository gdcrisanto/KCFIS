
<?php
  require_once "template.php";
  headertag("Add Staff Salary Statement");

  $stmt = $conn->prepare("SELECT *
                          FROM staffinfotab
                          WHERE staffID = ?");
  $stmt->bind_param("s", $_GET['staffid']);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $fname = $row['fname'];
    $mname = $row['mname'];
    $lname = $row['lname'];
    $employeeID = $row['employeeID'];
  }

  $stmt = $conn->prepare("SELECT monthlySalary, dateUpdated
                          FROM staffsalarytab
                          WHERE dateUpdated = (SELECT max(dateUpdated) FROM staffsalarytab WHERE staffID = ?)
                          AND staffID = ?");
  $stmt->bind_param("ss", $_GET['staffid'], $_GET['staffid']);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $monthlySalary = $row['monthlySalary'];
    $dateUpdated = $row['dateUpdated'];
  }
?>


    <div class="container form-box">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Add Staff Salary Statement
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

      <form role="form" method="post" action="includes/add_staff_salary_statement.inc.php?staffid=<?php echo $_GET['staffid']?>">

        <div class="row">
          <label for="date" class="col-sm-3 offset-sm-1">Date Issued:
            <input readonly value="<?php echo date("Y-m-d"); ?>" type="date" class="form-control" id="dateIssued" name="dateIssued">
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
            <input readonly value=<?php echo $monthlySalary?> type="text" class="form-control" id="monthlySalary" name="monthlySalary"/>
          </label>
        </div>

        <hr />

        <div class="row form-group">
          <label class="col-sm-4 offset-sm-4 text-center h5">Additionals: </label>
        </div>

        <div class="row">
          <label for="overtime pays" class="col-sm-5 offset-sm-1">Overtime Pays:
            <input min="0" onchange="compute2()" step="0.01" type="number" class="form-control" id="overtimePays" name="overtimePays">
          </label>
          <label for="paid leaves" class="col-sm-5">Paid Leaves:
            <input min="0" onchange="compute2()" step="0.01" type="number" class="form-control" id="paidLeaves" name="paidLeaves">
          </label>
        </div>

        <div class="row form-group">
          <label for="adjustments" class="col-sm-5 offset-sm-1">Adjustments:
            <input min="0" onchange="compute2()" step="0.01" type="number" class="form-control" id="adjustmentsAdd" name="adjustmentsAdd">
          </label>
        </div>

        <div class="row form-group">
          <label class="col-sm-4 offset-sm-4">Gross Income:
            <input readonly type="text" class="form-control" id="grossIncome" name="grossIncome"/>
          </label>
        </div>

        <hr />

        <div class="row form-group">
          <label class="col-sm-4 offset-sm-4 text-center h5">Deductions: </label>
        </div>

        <div class="row">
          <label for="sss" class="col-sm-5 offset-sm-1">SSS:
            <input min="0" onchange="compute2()" step="0.01" type="number" class="form-control" id="sss" name="sss">
          </label>
          <label for="philhealth" class="col-sm-5">Philhealth:
            <input min="0" onchange="compute2()" step="0.01" type="number" class="form-control" id="philhealth" name="philhealth">
          </label>
        </div>

        <div class="row">
          <label for="pagibig" class="col-sm-5 offset-sm-1">Pag-ibig:
            <input min="0" onchange="compute2()" step="0.01" type="number" class="form-control" id="pagibig" name="pagibig">
          </label>
          <label for="personalLoans" class="col-sm-5">Personal Loans:
            <input min="0" onchange="compute2()" step="0.01" type="number" class="form-control" id="personalLoans" name="personalLoans">
          </label>
        </div>

        <div class="row">
          <label for="undertime" class="col-sm-5 offset-sm-1">Undertime:
            <input min="0"onchange="compute2()" step="0.01" type="number" class="form-control" id="undertime" name="undertime">
          </label>
          <label for="absences" class="col-sm-5">Absences:
            <input min="0"onchange="compute2()" step="0.01" type="number" class="form-control" id="absences" name="absences">
          </label>
        </div>

        <div class="row form-group">
          <label for="withholdingTax" class="col-sm-5 offset-sm-1">Withholding Tax:
            <input min="0" onchange="compute2()" step="0.01" type="number" class="form-control" id="withholdingTax" name="withholdingTax">
          </label>
          <label for="adjustments" class="col-sm-5">Adjustments:
            <input min="0" onchange="compute2()" step="0.01" type="number" class="form-control" id="adjustmentsDeduc" name="adjustmentsDeduc">
          </label>
        </div>

        <div class="row form-group">
          <label class="col-sm-4 offset-sm-4">Net Income:
            <input readonly type="text" class="form-control" id="netIncome" name="netIncome"/>
          </label>
        </div>

        <div class="row pt-sm-3">
          <div class="col-sm-2 offset-sm-5">
            <input type="submit" value="Submit" name="add_staff_salary_statement_submit" class="btn btn-primary btn-block"/>
          </div>
        </div>
        <div class="row pt-sm-3">
          <a href='search_staff2.php' class="col-sm-2 offset-sm-5 btn btn-danger btn-block">
            Cancel
          </a>
        </div>

      </form>

    </div>

    <script>
      function compute2() {
        var monthlySalary = document.getElementById("monthlySalary").value;
        var overtimePays = document.getElementById("overtimePays").value;
        var paidLeaves = document.getElementById("paidLeaves").value;
        var adjustmentsAdd = document.getElementById("adjustmentsAdd").value;

        var sss = document.getElementById("sss").value;
        var philhealth = document.getElementById("philhealth").value;
        var pagibig = document.getElementById("pagibig").value;
        var personalLoans = document.getElementById("personalLoans").value;
        var undertime = document.getElementById("undertime").value;
        var absences = document.getElementById("absences").value;
        var withholdingTax = document.getElementById("withholdingTax").value;
        var adjustmentsDeduc = document.getElementById("adjustmentsDeduc").value;

        var grossIncome;
        var netIncome;

        grossIncome = Number(monthlySalary) + Number(overtimePays) + Number(paidLeaves) + Number(adjustmentsAdd);
        console.log(grossIncome);
        netIncome = Number(grossIncome) - (Number(sss) + Number(philhealth) + Number(pagibig) + Number(personalLoans) + Number(undertime) + Number(absences) + Number(withholdingTax) + Number(adjustmentsDeduc));
        document.getElementById("grossIncome").value = grossIncome;
        document.getElementById("netIncome").value = netIncome;

      }
      document.addEventListener("input", compute2())
    </script>
<?
  footertag();
?>
