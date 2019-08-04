
<?php
  require_once "template.php";
  headertag("View Student Information");
?>


    <div class="container form-box">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Student Info
        </div>
      </div>

      <?php
      require 'includes/db.inc.php';
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
                FROM studentinfotab
                WHERE studID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_GET['studid']);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
          $studID = $row['studID'];
          $studentno = $row['studentno'];
          $lname = $row['lname'];
          $fname = $row['fname'];
          $mname = $row['mname'];
          $contactno = $row['contactno'];
          $address = $row['address'];
        }
      ?>

      <div class="row">
        <label for="studentno" class="col-sm-5 offset-sm-1">Student No:
          <input disabled value="<?php echo empty($studentno) ? "" : $studentno; ?>" type="text" class="form-control" id="studentno" name="studentno">
        </label>
      </div>

      <div class="row">
        <label for="fname" class="col-sm-5 offset-sm-1">First Name:
          <input disabled value="<?php echo empty($fname) ? "" : $fname; ?>" type="text" class="form-control" id="fname" name="fname">
        </label>
        <label for="mname" class="col-sm-5">Middle Name:
          <input disabled value="<?php echo empty($mname) ? "" : $mname; ?>" type="text" class="form-control" id="mname" name="mname">
        </label>
      </div>

      <div class="row">
        <label for="lname" class="col-sm-5 offset-sm-1">Last Name:
          <input disabled value="<?php echo empty($lname) ? "" : $lname; ?>" type="text" class="form-control" id="lname" name="lname">
        </label>
        <label for="contactno" class="col-sm-5">Contact No.:
          <input disabled value="<?php echo empty($contactno) ? "" : $contactno; ?>" type="text" class="form-control" id="contactno" name="contactno">
        </label>
      </div>

      <div class="row form-group">
        <label for="address" class="col-sm-10 offset-sm-1">Address:
          <input disabled value="<?php echo empty($address) ? "" : $address; ?>" type="text" class="form-control" id="address" name="address">
        </label>
      </div>

      <div class="row pt-sm-3">
        <div class="col-sm-4 offset-sm-2 text-right">
          <a href="edit_student.php?studid=<?php echo $studID ?>" class="btn btn-primary">Edit Student Info</a>
        </div>
        <?php
          if ($_SESSION['usertype'] == 'Cashier') {
            ?>
            <div class="col-sm-3 text-left">
            <a href="student_acct_list.php?studid=<?php echo $studID ?>" class="btn btn-primary">View Accounts</a>
            </div>
            <?php
          }
        ?>
      </div>

    </div>
<?
  footertag();
?>
