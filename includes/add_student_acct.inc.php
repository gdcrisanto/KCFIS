<?php

  if (isset($_POST['student_acct_submit'])){

    require 'db.inc.php';

    $studID = $_GET['studid'];
    $acctno = $_POST['acctno'];
    $paymentPlan = $_POST['paymentPlan'];
    $dateUpdated = $_POST['dateUpdated'];
    $remainingBalance = $_POST['remainingBalance'];
    $semester = $_POST['semester'];

    // Error Handler
    // Checks empty fields
    if (empty($paymentPlan) || empty($dateUpdated) || empty($acctno) || empty($remainingBalance) || empty($semester)) {
      header("Location: ../add_student_acct.php?studid=".$studID."&error=emptyfields&paymentPlan=".$paymentPlan."&dateUpdated=".$dateUpdated);
      exit();
    }
    else {
      $sql = "INSERT INTO acctinfotab (paymentPlan, dateUpdated, studID, acctno, semester)
              VALUES (?, ?, ?, ?, ?)";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../add_student_acct.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "ssiis", $paymentPlan, $dateUpdated, $studID, $acctno, $semester);
        mysqli_stmt_execute($stmt);

        $acctinfoID = $conn->insert_id;
      }
      $sql = "INSERT INTO studtranstab (remainingBalance, acctinfoID, dateReceived)
              VALUES (?, ?, ?)";

      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../add_student_acct.php?error=sqlerror2");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "sss", $remainingBalance, $acctinfoID, $dateUpdated);
        mysqli_stmt_execute($stmt);

        header("Location: ../student_acct_list.php?studid=".$studID."&add_student_acct=success");
        exit();
      }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../add_student_acct.php?studid=".$studID);
    exit();

  }
