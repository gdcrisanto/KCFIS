<?php

  if (isset($_POST['add_fullpayment_submit'])){
    session_start();
    require 'db.inc.php';

    $dateReceived = $_POST['dateReceived'];
    $receiptNo = $_POST['receiptNo'];
    $remainingBalance = $_POST['remainingBalance'];
    $amountReceived = $_POST['amountReceived'];
    $modeOfPayment = $_POST['modeOfPayment'];
    $acctinfoID = $_GET['acctid'];

    // Error Handler
    // Checks empty fields
    if (empty($dateReceived) || empty($receiptNo) || empty($amountReceived) || empty($modeOfPayment)) {
      header("Location: ../add_fullpayment.php?acctid=".$acctinfoID."&error=emptyfields");
      exit();
    }
    else {
      $sql = "INSERT INTO studtranstab (dateReceived, receiptNo, remainingBalance, amountReceived, acctinfoID, modeOfPayment)
              VAlUES (?, ?, ?, ?, ?, ?)";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        var_dump($balance);
        // header("Location: ../add_fullpayment.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "ssssss", $dateReceived, $receiptNo, $remainingBalance, $amountReceived, $acctinfoID, $modeOfPayment);
        mysqli_stmt_execute($stmt);

        header("Location: ../view_payment_info.php?acctid=".$acctinfoID."&add_fullpayment=success");
        exit();
      }


    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../add_fullpayment.php");
    exit();

  }
