
<?php
  require_once "template.php";
  require_once "functions.php";
  headertag("Student Accounts");
  $sql = "SELECT *
          FROM studentinfotab
          WHERE studID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $_GET['studid']);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $studID = $row['studID'];
    $lname = $row['lname'];
    $fname = $row['fname'];
  }
?>


    <div class="container form-box-md">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          <?php echo $fname." ".$lname?>'s Accounts
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

      <div class="row form-group">
        <div class="col-sm-3 offset-sm-9">
          <a href="add_student_acct.php?studid=<?php echo $studID ?>" class="btn btn-block btn-primary">Add Account</a>
        </div>
      </div>

      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">Account No.</th>
            <th scope="col">Payment Plan</th>
            <th scope="col">Semester</th>
            <th scope="col">Date Updated</th>
          </tr>
        </thead>
        <tbody>
          <?php
            accountlist($studID);
          ?>
        </tbody>
      </table>

    </div>
<?php
  footertag();
?>
