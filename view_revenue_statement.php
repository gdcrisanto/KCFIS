
<?php
  require_once "template.php";
  require_once "functions.php";
  headertag("View Revenue Statement");


?>


    <div class="container form-box">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          View Revenue Statement
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
        FROM revstatementtab
        WHERE revstatementID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_GET['rsid']);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
          $dateStart = $row['dateStart'];
          $dateEnd = $row['dateEnd'];
          $dateCreated = $row['dateCreated'];
          $totalRevenue = $row['totalRevenue'];
        }

        $tuitionIncome = 0;
        $otherIncome = 0;

        $sql = "SELECT amountReceived
        FROM studtranstab
        WHERE dateReceived
        between ? and LAST_DAY(?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $dateStart, $dateEnd);
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
        $stmt->bind_param("ss", $dateStart, $dateEnd);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
          if ($row['amount'] > 0){
            $amount = $row['amount'];
            $otherIncome = $otherIncome + $amount;
          }
        }
      ?>

      <form role="form" method="post" action="gen_revenue_statement.php">

            <div class="container" id="incomestatement">

              <div class="row form-group">
                <label class="col-sm-4 offset-sm-2">
                  Start Date:
                  <input readonly value="<?php if (isset($dateStart)) {
                    echo $dateStart;
                  }?>" palceholder="Start Date" type="date" class="form-control" name="dateStart"/>
                </label>
                <label class="col-sm-4">
                  End Date:
                  <input readonly type="date" value="<?php if (isset($dateEnd)){
                    echo $dateEnd;
                  }
                  else {
                    echo date("Y-m-d");
                  }?>" class="form-control" name="dateEnd"/>
                </label>
              </div>
            </form>

            <hr />

            <?php
            if (isset($dateStart) || isset($dateEnd)) {
              ?>
              <form role="form" method="post" action="includes/gen_revenue_statement.inc.php">
                <input hidden name="dateStart" type="date" value="<?php echo $dateStart ?>" />
                <input hidden name="dateEnd" type="date" value="<?php echo $dateEnd ?>" />
                <div class="row form-group">
                  <label class="col-sm-4 offset-sm-4 text-center h6">
                    Date Created:
                    <input readonly type="date" value="<?php echo date("Y-m-d"); ?>" class="form-control" name="dateCreated"/>
                  </label>
                </div>

                <div class="col-sm-10 offset-sm-1 mt-sm-5">
                  <div class="row form-group">
                    <label class="col-sm-6 offset-sm-3 text-center h5">Student Tuition Income: </label>
                  </div>

                  <table class="table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Student No.</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date Received</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        studrevenuelist($dateStart, $dateEnd)
                      ?>
                    </tbody>
                  </table>

                  <div class="row form-group">
                    <label class="col-sm-8 offset-sm-2 text-center h6">
                      Tuition Income Total:
                      <input readonly value="<?php echo $tuitionIncome?>" type="number" step="0.01"class="form-control col-sm-6 offset-sm-3" name="totalRevenue"/>
                    </label>
                  </div>

                  <div class="row form-group">
                    <label class="col-sm-6 offset-sm-3 mt-sm-5 text-center h5">Other Income: </label>
                  </div>

                  <table class="table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Received From</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date Received</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        otherrevenuelist($dateStart, $dateEnd)
                      ?>
                    </tbody>
                  </table>

                  <div class="row form-group">
                    <label class="col-sm-8 offset-sm-2 text-center h6">
                      Other Income Total:
                      <input readonly value="<?php echo $otherIncome?>" type="number" step="0.01"class="form-control col-sm-6 offset-sm-3" name="totalRevenue"/>
                    </label>
                  </div>

                  <div class="row form-group">
                    <label class="col-sm-8 offset-sm-2 mt-sm-5 text-center h6">
                      Total Revenue:
                      <input readonly value="<?php echo $totalRevenue?>" type="number" step="0.01"class="form-control col-sm-6 offset-sm-3" name="totalRevenue"/>
                    </label>
                  </div>
                </div>

            </div>

            <hr />

            <div class="row form-group">
              <label class="col-sm-2 offset-sm-5 btn-lg btn btn-primary btn-block" onclick="printlayer('incomestatement')">Print</label>
            </div>
          </form>
          <?php
        }
      ?>
      <div class="row form-group">
        <a href='revenue_statement_list.php' class="col-sm-2 offset-sm-5 btn btn-danger btn-block"/>
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
