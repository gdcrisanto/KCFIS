<?php

// FACULTY FUNCTIONS

function payratelist($facID){
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM facultyratetab
          WHERE facID = ?
          ORDER BY dateUpdated DESC";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $facID);
  $stmt->execute();
  $result = $stmt->get_result();
  $count = 1;
  while($row = $result->fetch_assoc()){
    $hourlyRate = $row['hourlyRate'];
    $dateUpdated = $row['dateUpdated'];
    ?>
    <tr>
      <th scope="row"><?php echo $count ?></th>
      <td><?php echo $hourlyRate ?></td>
      <td><?php echo $dateUpdated ?></td>
    </tr>
    <?php
    $count = $count + 1;
  }
}

function search_faculty($string) {
  require 'includes/db.inc.php';
  $search = mysqli_real_escape_string($conn, $string);
  $sql = "SELECT *
          FROM facultyinfotab
          WHERE employeeID LIKE '%$search%'
          OR fname LIKE '%$search%'
          OR lname LIKE '%$search%' ";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $facID = $row['facID'];
    $employeeID = $row['employeeID'];
    $lname = $row['lname'];
    $fname = $row['fname'];
    ?>
    <tr onclick="document.location='view_faculty.php?facid=<?php echo $facID ?>'">
      <th scope="row"><?php echo $employeeID ?></th>
      <td><?php echo $fname ?></td>
      <td><?php echo $lname ?></td>
    </tr>
    <?php
  }
}

function search_faculty2() {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM facultyinfotab
          WHERE employeeID = ? OR fname = ? OR lname = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $_POST['faculty'], $_POST['faculty'], $_POST['faculty']);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $facID = $row['facID'];
    $employeeID = $row['employeeID'];
    $lname = $row['lname'];
    $fname = $row['fname'];
    ?>
    <tr onclick="document.location='add_faculty_salary_statement.php?facid=<?php echo $facID ?>'">
      <th scope="row"><?php echo $employeeID ?></th>
      <td><?php echo $fname ?></td>
      <td><?php echo $lname ?></td>
    </tr>
    <?php
  }
}

function facultylist() {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM facultyinfotab";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $facID = $row['facID'];
    $employeeID = $row['employeeID'];
    $lname = $row['lname'];
    $fname = $row['fname'];
    ?>
    <tr onclick="document.location='view_faculty.php?facid=<?php echo $facID ?>'">
      <th scope="row"><?php echo $employeeID ?></th>
      <td><?php echo $fname ?></td>
      <td><?php echo $lname ?></td>
    </tr>
    <?php
  }
}

function facultylist2() {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM facultyinfotab";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $facID = $row['facID'];
    $employeeID = $row['employeeID'];
    $lname = $row['lname'];
    $fname = $row['fname'];
    ?>
    <tr onclick="document.location='add_faculty_salary_statement.php?facid=<?php echo $facID ?>'">
      <th scope="row"><?php echo $employeeID ?></th>
      <td><?php echo $fname ?></td>
      <td><?php echo $lname ?></td>
    </tr>
    <?php
  }
}

function facultystatementlist() {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM facsalarystatementtab";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $facsalarystatementID = $row['facsalarystatementID'];
    $facID = $row['facID'];
    $dateIssued = $row['dateIssued'];
    $sql = "SELECT *
            FROM facultyinfotab
            WHERE facID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $facID);
    $stmt->execute();
    $result2 = $stmt->get_result();
    while($row2 = $result2->fetch_assoc()){
      $lname = $row2['lname'];
      $fname = $row2['fname'];
      $employeeID = $row2['employeeID'];
    }
    ?>
    <tr onclick="document.location='view_faculty_salary_statement.php?facid=<?php echo $facsalarystatementID ?>'">
      <th scope="row"><?php echo $dateIssued ?></th>
      <td><?php echo $employeeID ?></th>
      <td><?php echo $fname ?></td>
      <td><?php echo $lname ?></td>
    </tr>
    <?php
  }
}

// STAFF FUNCTIONS

function salarylist($staffID){
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM staffsalarytab
          WHERE staffID = ?
          ORDER BY dateUpdated DESC";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $staffID);
  $stmt->execute();
  $result = $stmt->get_result();
  $count = 1;
  while($row = $result->fetch_assoc()){
    $monthlySalary = $row['monthlySalary'];
    $dateUpdated = $row['dateUpdated'];
    ?>
    <tr>
      <th scope="row"><?php echo $count ?></th>
      <td><?php echo $monthlySalary ?></td>
      <td><?php echo $dateUpdated ?></td>
    </tr>
    <?php
    $count = $count + 1;
  }
}

function search_staff($string) {
  require 'includes/db.inc.php';
  $search = mysqli_real_escape_string($conn, $string);
  $sql = "SELECT *
          FROM staffinfotab
          WHERE employeeID LIKE '%$search%'
          OR fname LIKE '%$search%'
          OR lname LIKE '%$search%'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $staffID = $row['staffID'];
    $employeeID = $row['employeeID'];
    $lname = $row['lname'];
    $fname = $row['fname'];
    ?>
    <tr onclick="document.location='view_staff.php?staffid=<?php echo $staffID ?>'">
      <th scope="row"><?php echo $employeeID ?></th>
      <td><?php echo $fname ?></td>
      <td><?php echo $lname ?></td>
    </tr>
    <?php
  }
}

function search_staff2() {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM staffinfotab
          WHERE employeeID = ? OR fname = ? OR lname = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $_POST['staff'], $_POST['staff'], $_POST['staff']);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $staffID = $row['staffID'];
    $employeeID = $row['employeeID'];
    $lname = $row['lname'];
    $fname = $row['fname'];
    ?>
    <tr onclick="document.location='add_staff_salary_statement.php?staffid=<?php echo $staffID ?>'">
      <th scope="row"><?php echo $employeeID ?></th>
      <td><?php echo $fname ?></td>
      <td><?php echo $lname ?></td>
    </tr>
    <?php
  }
}

function stafflist() {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM staffinfotab";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $staffID = $row['staffID'];
    $employeeID = $row['employeeID'];
    $lname = $row['lname'];
    $fname = $row['fname'];
    ?>
    <tr onclick="document.location='view_staff.php?staffid=<?php echo $staffID ?>'">
      <th scope="row"><?php echo $employeeID ?></th>
      <td><?php echo $fname ?></td>
      <td><?php echo $lname ?></td>
    </tr>
    <?php
  }
}

function stafflist2() {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM staffinfotab";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $staffID = $row['staffID'];
    $employeeID = $row['employeeID'];
    $lname = $row['lname'];
    $fname = $row['fname'];
    ?>
    <tr onclick="document.location='add_staff_salary_statement.php?staffid=<?php echo $staffID ?>'">
      <th scope="row"><?php echo $employeeID ?></th>
      <td><?php echo $fname ?></td>
      <td><?php echo $lname ?></td>
    </tr>
    <?php
  }
}

function staffstatementlist() {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM staffsalarystatementtab";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $staffsalarystateID = $row['staffsalarystateID'];
    $staffID = $row['staffID'];
    $dateIssued = $row['dateIssued'];
    $sql = "SELECT *
            FROM staffinfotab
            WHERE staffID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $staffID);
    $stmt->execute();
    $result2 = $stmt->get_result();
    while($row2 = $result2->fetch_assoc()){
      $lname = $row2['lname'];
      $fname = $row2['fname'];
      $employeeID = $row2['employeeID'];
    }
    ?>
    <tr onclick="document.location='view_staff_salary_statement.php?staffid=<?php echo $staffsalarystateID?>'">
      <th scope="row"><?php echo $dateIssued ?></th>
      <td><?php echo $employeeID ?></th>
      <td><?php echo $fname ?></td>
      <td><?php echo $lname ?></td>
    </tr>
    <?php
  }
}

// STUDENT FUNCTIONS

function search_student($string) {
  require 'includes/db.inc.php';
  $search = mysqli_real_escape_string($conn, $string);
  $sql = "SELECT *
          FROM studentinfotab
          WHERE studentno LIKE '%$search%'
          OR fname LIKE '%$search%'
          OR lname LIKE '%$search%'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $studID = $row['studID'];
    $studentno = $row['studentno'];
    $lname = $row['lname'];
    $fname = $row['fname'];
    ?>
    <tr onclick="document.location='view_student.php?studid=<?php echo $studID ?>'">
      <th scope="row"><?php echo $studentno ?></th>
      <td><?php echo $fname ?></td>
      <td><?php echo $lname ?></td>
    </tr>
    <?php
  }
}

function search_student2($string) {
  require 'includes/db.inc.php';
  $search = mysqli_real_escape_string($conn, $string);
  $sql = "SELECT *
          FROM studentinfotab
          WHERE studentno LIKE '%$search%'
          OR fname LIKE '%$search%'
          OR lname LIKE '%$search%'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $studID = $row['studID'];
    $studentno = $row['studentno'];
    $lname = $row['lname'];
    $fname = $row['fname'];
    ?>
    <tr onclick="document.location='student_acct_list.php?studid=<?php echo $studID ?>'">
      <th scope="row"><?php echo $studentno ?></th>
      <td><?php echo $fname ?></td>
      <td><?php echo $lname ?></td>
    </tr>
    <?php
  }
}

function studentlist() {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM studentinfotab";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $studID = $row['studID'];
    $studentno = $row['studentno'];
    $lname = $row['lname'];
    $fname = $row['fname'];
    ?>
    <tr onclick="document.location='view_student.php?studid=<?php echo $studID ?>'">
      <th scope="row"><?php echo $studentno ?></th>
      <td><?php echo $fname ?></td>
      <td><?php echo $lname ?></td>
    </tr>
    <?php
  }
}

function studentacctlist() {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM studentinfotab";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $studID = $row['studID'];
    $studentno = $row['studentno'];
    $lname = $row['lname'];
    $fname = $row['fname'];
    ?>
    <tr onclick="document.location='student_acct_list.php?studid=<?php echo $studID ?>'">
      <th scope="row"><?php echo $studentno ?></th>
      <td><?php echo $fname ?></td>
      <td><?php echo $lname ?></td>
    </tr>
    <?php
  }
}

function search_student3($string) {
  require 'includes/db.inc.php';
  $search = mysqli_real_escape_string($conn, $string);
  $sql = "SELECT *
          FROM studtranstab";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $dateReceived = $row['dateReceived'];
    $receiptNo = $row['receiptNo'];
    $acctinfoID = $row['acctinfoID'];

    $sql = "SELECT *
            FROM acctinfotab
            WHERE acctinfoID=?";
    $stmt2 = $conn->prepare($sql);
    $stmt2->bind_param("s", $acctinfoID);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    while($row2 = $result2->fetch_assoc()){
      $studID = $row2['studID'];
      $paymentPlan = $row2['paymentPlan'];
    }
    $sql = "SELECT *
            FROM studentinfotab
            WHERE studID=?
            AND (studentno LIKE '%$search%'
            OR fname LIKE '%$search%'
            OR lname LIKE '%$search%')";
    $stmt3 = $conn->prepare($sql);
    $stmt3->bind_param("s", $studID);
    $stmt3->execute();
    $result3 = $stmt3->get_result();
    while($row3 = $result3->fetch_assoc()){
      $fname = $row3['fname'];
      $lname = $row3['lname'];
      $studentno = $row3['studentno'];
    }

    if ($receiptNo != "0"){
      if ($paymentPlan == "Full Payment"){
        ?>
        <tr onclick="document.location='view_payment_info.php?acctid=<?php echo $acctinfoID ?>'">
        <?php
      }
      else if ($paymentPlan == "Installment"){
        ?>
        <tr onclick="document.location='view_payment_info.php?acctid=<?php echo $acctinfoID ?>'">
        <?php
      }?>
        <th scope="row"><?php echo $dateReceived ?></th>
        <td><?php echo $studentno ?></td>
        <td><?php echo $fname ?></td>
        <td><?php echo $lname ?></td>
        <td><?php echo $receiptNo ?></td>
      </tr>
      <?php
    }
  }
}

function studenttranslist() {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM studtranstab";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $dateReceived = $row['dateReceived'];
    $receiptNo = $row['receiptNo'];
    $acctinfoID = $row['acctinfoID'];
    $studtransID = $row['studtransID'];

    $sql = "SELECT *
            FROM acctinfotab
            WHERE acctinfoID=?";
    $stmt2 = $conn->prepare($sql);
    $stmt2->bind_param("s", $acctinfoID);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    while($row2 = $result2->fetch_assoc()){
      $studID = $row2['studID'];
      $paymentPlan = $row2['paymentPlan'];
    }
    $sql = "SELECT *
            FROM studentinfotab
            WHERE studID=?";
    $stmt3 = $conn->prepare($sql);
    $stmt3->bind_param("s", $studID);
    $stmt3->execute();
    $result3 = $stmt3->get_result();
    while($row3 = $result3->fetch_assoc()){
      $fname = $row3['fname'];
      $lname = $row3['lname'];
      $studentno = $row3['studentno'];
    }

    if ($receiptNo != "0"){
        ?>
        <tr onclick="document.location='view_student_trans.php?studid=<?php echo $studtransID ?>'">
        <th scope="row"><?php echo $dateReceived ?></th>
        <td><?php echo $studentno ?></td>
        <td><?php echo $fname ?></td>
        <td><?php echo $lname ?></td>
        <td><?php echo $receiptNo ?></td>
      </tr>
      <?php
    }
  }
}

function outstandingbalances() {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM acctinfotab";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $studID = $row['studID'];
    $acctno = $row['acctno'];
    $acctinfoID = $row['acctinfoID'];
    $paymentPlan = $row['paymentPlan'];

    $sql = "SELECT remainingBalance
            FROM studtranstab
            WHERE dateReceived = (SELECT max(dateReceived) FROM studtranstab WHERE acctinfoID = ?)
            AND acctinfoID = ?";
    $stmt2 = $conn->prepare($sql);
    $stmt2->bind_param("ss", $acctinfoID, $acctinfoID);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    while($row2 = $result2->fetch_assoc()){
      $remainingBalance = $row2['remainingBalance'];
    }

    $sql = "SELECT *
            FROM studentinfotab
            WHERE studID=?";
    $stmt3 = $conn->prepare($sql);
    $stmt3->bind_param("s", $studID);
    $stmt3->execute();
    $result3 = $stmt3->get_result();
    while($row3 = $result3->fetch_assoc()){
      $fname = $row3['fname'];
      $lname = $row3['lname'];
      $studentno = $row3['studentno'];
    }

    if ($remainingBalance > 0){
      ?>
      <tr <?php
        if($paymentPlan=="Installment"){
          ?> onclick="document.location='view_installment_list.php?acctid=<?php echo $acctinfoID ?>'" <?php
        }
        else if ($paymentPlan=="Full Payment"){
          ?> onclick="document.location='view_payment_info.php?acctid=<?php echo $acctinfoID ?>'" <?php
        }
        ?>>
        <th scope="row"><?php echo $acctno ?></th>
        <td><?php echo $studentno ?></td>
        <td><?php echo $fname ?></td>
        <td><?php echo $lname ?></td>
        <td><?php echo $remainingBalance?></td>
      </tr>
      <?php
    }
  }
}

function accountlist($studID) {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM acctinfotab
          WHERE studID = ?
          ORDER BY dateUpdated DESC";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $studID);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $acctinfoID = $row['acctinfoID'];
    $studID = $row['studID'];
    $acctno = $row['acctno'];
    $paymentPlan = $row['paymentPlan'];
    $dateUpdated = $row['dateUpdated'];
    $semester = $row['semester'];

    ?>
    <tr <?php
      if($paymentPlan=="Installment"){
        ?> onclick="document.location='view_installment_list.php?acctid=<?php echo $acctinfoID ?>'" <?php
      }
      else if ($paymentPlan=="Full Payment"){
        ?> onclick="document.location='view_payment_info.php?acctid=<?php echo $acctinfoID ?>'" <?php
      }
      ?>>
      <th scope="row"><?php echo $acctno ?></th>
      <td><?php echo $paymentPlan ?></td>
      <td><?php echo $semester ?></td>
      <td><?php echo $dateUpdated ?></td>
    </tr>
    <?php
  }
}

function installmentlist($acctinfoID) {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM studtranstab
          WHERE acctinfoID = ?
          ORDER BY dateReceived DESC";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $acctinfoID);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $studtransID = $row['studtransID'];
    $acctinfoID = $row['acctinfoID'];
    $amountReceived = $row['amountReceived'];
    $dateReceived = $row['dateReceived'];
    $receiptNo = $row['receiptNo'];

    if ($receiptNo != 0){
      ?>
      <tr onclick="document.location='view_student_trans.php?studid=<?php echo $studtransID?>'">
        <td><?php echo $receiptNo ?></td>
        <td><?php echo $amountReceived ?></td>
        <td><?php echo $dateReceived ?></td>
      </tr>
      <?php
    }
  }
}

function fullpaymentlist($acctinfoID) {
  require 'includes/db.inc.php';

  $sql = "SELECT *
          FROM studtranstab
          WHERE dateReceived = (SELECT max(dateReceived) FROM studtranstab WHERE acctinfoID = ?)
          AND acctinfoID = ?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $acctinfoID, $acctinfoID);
  $stmt->execute();
  $result = $stmt->get_result();

  while($row = $result->fetch_assoc()){
    $studtransID = $row['studtransID'];
    $acctinfoID = $row['acctinfoID'];
    $amountReceived = $row['amountReceived'];
    $dateReceived = $row['dateReceived'];
    $receiptNo = $row['receiptNo'];

    if ($receiptNo != 0){
      ?>
      <tr onclick="document.location='view_student_trans.php?studid=<?php echo $studtransID?>'">
        <td><?php echo $receiptNo ?></td>
        <td><?php echo $amountReceived ?></td>
        <td><?php echo $dateReceived ?></td>
      </tr>
      <?php
    }
  }
}

// EXPENSES FUNCTIONS

function expenseslist() {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM expensetab
          ORDER BY datePurchased DESC";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $expenseID = $row['expenseID'];
    $expenseType = $row['expenseType'];
    $datePurchased = $row['datePurchased'];
    $amount = $row['amount'];
    ?>
    <tr onclick="document.location='view_expense_details.php?expnsid=<?php echo $expenseID ?>'">
      <td><?php echo $datePurchased ?></td>
      <td><?php echo $expenseType ?></td>
      <td><?php echo $amount ?></td>
    </tr>
    <?php
  }
}

// OTHER INCOME FUNCTION

function otherincomesearch($string) {
  require 'includes/db.inc.php';
  $search = mysqli_real_escape_string($conn, $string);
  $sql = "SELECT *
          FROM otherincometab
          WHERE (receivedFrom LIKE '%$search%' OR ackReceiptNo LIKE '%$search%')
          ORDER BY dateReceived DESC";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $otherIncomeID = $row['otherIncomeID'];
    $receivedFrom = $row['receivedFrom'];
    $dateReceived = $row['dateReceived'];
    $amount = $row['amount'];
    $ackReceiptNo = $row['ackReceiptNo'];
    ?>
    <tr onclick="document.location='view_other_income_trans.php?oiid=<?php echo $otherIncomeID ?>'">
      <td><?php echo $dateReceived ?></td>
      <td><?php echo $receivedFrom ?></td>
      <td><?php echo $amount ?></td>
      <td><?php echo $ackReceiptNo ?></td>
    </tr>
    <?php
  }
}

function otherincomelist() {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM otherincometab
          ORDER BY dateReceived DESC";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $otherIncomeID = $row['otherIncomeID'];
    $receivedFrom = $row['receivedFrom'];
    $dateReceived = $row['dateReceived'];
    $amount = $row['amount'];
    $ackReceiptNo = $row['ackReceiptNo'];
    ?>
    <tr onclick="document.location='view_other_income_trans.php?oiid=<?php echo $otherIncomeID ?>'">
      <td><?php echo $dateReceived ?></td>
      <td><?php echo $receivedFrom ?></td>
      <td><?php echo $amount ?></td>
      <td><?php echo $ackReceiptNo ?></td>
    </tr>
    <?php
  }
}

// USERS FUNCTIONS

function search_user() {
  require 'includes/db.inc.php';
  $sql = "SELECT *
  FROM facultyinfotab
  WHERE employeeID = ? OR fname = ? OR lname = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $_POST['faculty'], $_POST['faculty'], $_POST['faculty']);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $facID = $row['facID'];
    $employeeID = $row['employeeID'];
    $lname = $row['lname'];
    $fname = $row['fname'];
    ?>
    <tr onclick="document.location='view_faculty.php?facid=<?php echo $facID ?>'">
      <th scope="row"><?php echo $employeeID ?></th>
      <td><?php echo $fname ?></td>
      <td><?php echo $lname ?></td>
    </tr>
    <?php
  }
}

function userlist() {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM usertab ";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $usertype = $row['usertype'];
    $username = $row['username'];
    $userstatus = $row['userstatus'];
    ?>
    <tr>
      <td><?php echo $userstatus ?></td>
      <td><?php echo $usertype ?></td>
      <td><?php echo $username ?></td>
    </tr>
    <?php
  }
}

function userlist2() {
  require 'includes/db.inc.php';
  // $type = "Enabled";
  $sql = "SELECT *
          FROM usertab ";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $userID = $row['userID'];
    $usertype = $row['usertype'];
    $username = $row['username'];
    $userstatus = $row['userstatus'];
    ?>
    <tr  onclick="document.location='change_user_status.php?uid=<?php echo $userID ?>'">
      <td><?php echo $userstatus ?></td>
      <td><?php echo $usertype ?></td>
      <td><?php echo $username ?></td>
    </tr>
    <?php
  }
}

function incomestatelist() {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM incomestatementtab
          ORDER BY dateCreated DESC";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $incomestatementID = $row['incomestatementID'];
    $dateEnd = $row['dateEnd'];
    $dateStart = $row['dateStart'];
    $dateCreated = $row['dateCreated'];
    $totalRevenue = $row['totalRevenue'];
    $totalExpense = $row['totalExpense'];
    $totalIncome = $row['totalIncome'];
    ?>
    <tr  onclick="document.location='view_income_statement.php?isid=<?php echo $incomestatementID ?>'">
      <td><?php echo $dateCreated ?></td>
      <td>PHP <?php echo $totalIncome ?></td>
      <td><?php echo $dateStart ?></td>
      <td><?php echo $dateEnd ?></td>
    </tr>
    <?php
  }
}

function revenuestatelist() {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM revstatementtab
          ORDER BY dateCreated DESC";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $revstatementID = $row['revstatementID'];
    $dateEnd = $row['dateEnd'];
    $dateStart = $row['dateStart'];
    $dateCreated = $row['dateCreated'];
    $totalRevenue = $row['totalRevenue'];
    ?>
    <tr  onclick="document.location='view_revenue_statement.php?rsid=<?php echo $revstatementID ?>'">
      <td><?php echo $dateCreated ?></td>
      <td>PHP <?php echo $totalRevenue ?></td>
      <td><?php echo $dateStart ?></td>
      <td><?php echo $dateEnd ?></td>
    </tr>
    <?php
  }
}

function studrevenuelist($dateStart, $dateEnd) {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM studtranstab
          WHERE dateReceived
          between ? and LAST_DAY(?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $dateStart, $dateEnd);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    if ($row['amountReceived'] > 0){
      $studtransID = $row['studtransID'];
      $acctinfoID = $row['acctinfoID'];
      $amountReceived = $row['amountReceived'];
      $dateReceived = $row['dateReceived'];
      $sql2 = "SELECT *
              FROM acctinfotab
              WHERE acctinfoID = ?";
      $stmt2 = $conn->prepare($sql2);
      $stmt2->bind_param("s", $acctinfoID);
      $stmt2->execute();
      $result2 = $stmt2->get_result();
      while($row2 = $result2->fetch_assoc()){
        $studID = $row2['studID'];
      }
      $sql3 = "SELECT *
              FROM studentinfotab
              WHERE studID = ?";
      $stmt3 = $conn->prepare($sql3);
      $stmt3->bind_param("s", $studID);
      $stmt3->execute();
      $result3 = $stmt3->get_result();
      while($row3 = $result3->fetch_assoc()){
        $studentno = $row3['studentno'];
      }
    ?>
    <tr>
      <td><?php echo $studentno ?></td>
      <td>PHP <?php echo $amountReceived ?></td>
      <td><?php echo $dateReceived ?></td>
    </tr>
    <?php
    }
  }
}

function otherrevenuelist($dateStart, $dateEnd) {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM otherincometab
          WHERE dateReceived
          between ? and LAST_DAY(?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $dateStart, $dateEnd);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    if ($row['amount'] > 0){
      $receivedFrom = $row['receivedFrom'];
      $amount = $row['amount'];
      $dateReceived = $row['dateReceived'];
    ?>
    <tr>
      <td><?php echo $receivedFrom ?></td>
      <td>PHP <?php echo $amount ?></td>
      <td><?php echo $dateReceived ?></td>
    </tr>
    <?php
    }
  }
}

function expensestatelist() {
  require 'includes/db.inc.php';
  $sql = "SELECT *
  FROM expstatementtab
  ORDER BY dateCreated DESC";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $expstatementID = $row['expstatementID'];
    $dateEnd = $row['dateEnd'];
    $dateStart = $row['dateStart'];
    $dateCreated = $row['dateCreated'];
    $totalExpense = $row['totalExpense'];
    ?>
    <tr  onclick="document.location='view_expense_statement.php?esid=<?php echo $expstatementID ?>'">
      <td><?php echo $dateCreated ?></td>
      <td>PHP <?php echo $totalExpense ?></td>
      <td><?php echo $dateStart ?></td>
      <td><?php echo $dateEnd ?></td>
    </tr>
    <?php
  }
}

function facexplist($dateStart, $dateEnd) {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM facsalarystatementtab
          WHERE dateIssued
          between ? and LAST_DAY(?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $dateStart, $dateEnd);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $netIncome = $row['netIncome'];
    $dateIssued = $row['dateIssued'];
    $facID = $row['facID'];
    $sql2 = "SELECT *
            FROM facultyinfotab
            WHERE facID = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("s", $facID);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    while($row2 = $result2->fetch_assoc()){
      $employeeID = $row2['employeeID'];
    }
    ?>
    <tr>
      <td><?php echo $employeeID ?></td>
      <td>PHP <?php echo $netIncome ?></td>
      <td><?php echo $dateIssued ?></td>
    </tr>
    <?php
  }
}

function staffexplist($dateStart, $dateEnd) {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM staffsalarystatementtab
          WHERE dateIssued
          between ? and LAST_DAY(?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $dateStart, $dateEnd);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $netIncome = $row['netIncome'];
    $dateIssued = $row['dateIssued'];
    $staffID = $row['staffID'];
    $sql2 = "SELECT *
            FROM staffinfotab
            WHERE staffID = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("s", $staffID);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    while($row2 = $result2->fetch_assoc()){
      $employeeID = $row2['employeeID'];
    }
    ?>
    <tr>
      <td><?php echo $employeeID ?></td>
      <td>PHP <?php echo $netIncome ?></td>
      <td><?php echo $dateIssued ?></td>
    </tr>
    <?php
  }
}

function otherexplist($dateStart, $dateEnd) {
  require 'includes/db.inc.php';
  $sql = "SELECT *
          FROM expensetab
          WHERE datePurchased
          between ? and LAST_DAY(?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $dateStart, $dateEnd);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $amount = $row['amount'];
    $datePurchased = $row['datePurchased'];
    $expenseType = $row['expenseType'];
    ?>
    <tr>
      <td><?php echo $expenseType ?></td>
      <td>PHP <?php echo $amount ?></td>
      <td><?php echo $datePurchased ?></td>
    </tr>
    <?php
  }
}

?>
