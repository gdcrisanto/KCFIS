
<?php
  require_once "template.php";
  headertag("Add Faculty Salary Statement");

  $stmt = $conn->prepare("SELECT *
                          FROM facultyinfotab
                          WHERE facID = ?");
  $stmt->bind_param("s", $_GET['facid']);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $fname = $row['fname'];
    $mname = $row['mname'];
    $lname = $row['lname'];
    $employeeID = $row['employeeID'];
  }

  $stmt = $conn->prepare("SELECT hourlyRate, dateUpdated
                          FROM facultyratetab
                          WHERE dateUpdated = (SELECT max(dateUpdated) FROM facultyratetab WHERE facID = ?)
                          AND facID = ?");
  $stmt->bind_param("ss", $_GET['facid'], $_GET['facid']);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $hourlyRate = $row['hourlyRate'];
    $dateUpdated = $row['dateUpdated'];
  }
?>


    <div class="container form-box">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Add Faculty Salary Statement
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
            <input readonly step="0.01" value="<?php echo $hourlyRate?>" type="number" class="form-control" id="hourlyRate" name="hourlyRate">
          </label>
          <label class="col-sm-5">Total Hours:
            <input step="0.01" onchange="compute()" type="number" class="form-control" id="hoursWorked" name="hoursWorked">
          </label>
        </div>

        <div class="row">
          <label class="col-sm-5 offset-sm-1">Gross Income:
            <input readonly step="0.01" type="number" class="form-control" id="grossIncome" name="grossIncome">
          </label>
          <label class="col-sm-5">Widthholding Tax (10%):
            <input readonly step="0.01" value="<?php ?>"type="number" class="form-control" id="withholdingTax" name="withholdingTax">
          </label>
        </div>

        <div class="row form-group">
          <label class="col-sm-4 offset-sm-4">Net Income:
            <input readonly step="0.01" type="number" class="form-control" id="netIncome" name="netIncome"/>
          </label>
        </div>

        <div class="row pt-sm-3">
          <div class="col-sm-4 offset-sm-4">
            <input type="submit" value="Submit" name="add_fac_salary_statement_submit" class="btn btn-primary btn-block"/>
          </div>
        </div>
        <div class="row pt-sm-3">
          <a href='search_faculty2.php' class="col-sm-2 offset-sm-5 btn btn-danger btn-block">
            Cancel
          </a>
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
      document.addEventListener("input", compute());
    </script>
<?
  footertag();
?>
