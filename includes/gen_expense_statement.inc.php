<?php

  if (isset($_POST['gen_expense_statement'])){

    session_start();
    require 'db.inc.php';

    $dateEnd = $_POST['dateEnd'];
    $dateStart = $_POST['dateStart'];
    $dateCreated = $_POST['dateCreated'];
    $totalExpense = $_POST['totalExpense'];

    // Error Handler
    // Checks empty fields
    if (empty($totalExpense) || empty($dateCreated) || empty($dateStart) || empty($dateEnd)) {
      header("Location: ../gen_expense_statement.php?error=emptyfields");
      exit();
    }
    else {
      $sql = "INSERT INTO expstatementtab (dateEnd, dateStart, dateCreated, totalExpense)
              VAlUES (?, ?, ?, ?)";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../gen_expense_statement.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "ssss", $dateEnd, $dateStart, $dateCreated, $totalExpense);
        mysqli_stmt_execute($stmt);

        header("Location: ../expense_statement_list.php?gen_expense_statement=success");
        exit();
      }


    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../gen_expense_statement.php");
    exit();

  }
