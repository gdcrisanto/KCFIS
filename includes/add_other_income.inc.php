<?php

  if (isset($_POST['add_other_income_submit'])){

    session_start();
    require 'db.inc.php';

    $dateReceived = $_POST['dateReceived'];
    $ackReceiptNo = $_POST['ackReceiptNo'];
    $receivedFrom = $_POST['receivedFrom'];
    $amount = $_POST['amount'];
    $userID = $_SESSION['userID'];

    // Error Handler
    // Checks empty fields
    if (empty($dateReceived) || empty($ackReceiptNo) || empty($receivedFrom) || empty($amount)) {
      header("Location: ../add_other_income.php?error=emptyfields");
      exit();
    }
    else {
      $sql = "INSERT INTO otherincometab (dateReceived, ackReceiptNo, receivedFrom, amount, userID)
              VAlUES (?, ?, ?, ?, ?)";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../add_other_income.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "sssss", $dateReceived, $ackReceiptNo, $receivedFrom, $amount, $userID);
        mysqli_stmt_execute($stmt);

        header("Location: ../other_income_list.php?add_other_income=success");
        exit();
      }


    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../add_other_income.php");
    exit();

  }
