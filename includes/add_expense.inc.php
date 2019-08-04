<?php

  if (isset($_POST['add_expense_submit'])){

    session_start();
    require 'db.inc.php';

    $datePurchased = $_POST['datePurchased'];
    $expenseType = $_POST['expenseType'];
    $amount = $_POST['amount'];
    $remarks = $_POST['remarks'];
    $userID = $_SESSION['userID'];

    // Error Handler
    // Checks empty fields
    if (empty($datePurchased) || empty($expenseType) || empty($amount) || empty($remarks)) {
      header("Location: ../add_expense.php?error=emptyfields");
      exit();
    }
    else {
      $sql = "INSERT INTO expensetab (datePurchased, expenseType, amount, remarks, userID)
              VAlUES (?, ?, ?, ?, ?)";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../add_expense.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "ssiss", $datePurchased, $expenseType, $amount, $remarks, $userID);
        mysqli_stmt_execute($stmt);

        header("Location: ../expenses_list.php?add_expense=success");
        exit();
      }


    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../add_expense.php");
    exit();

  }
