<?php

  if (isset($_POST['gen_income_statement'])){

    session_start();
    require 'db.inc.php';

    $dateEnd = $_POST['dateEnd'];
    $dateStart = $_POST['dateStart'];
    $dateCreated = $_POST['dateCreated'];
    $totalRevenue = $_POST['totalRevenue'];
    $totalExpense = $_POST['totalExpense'];
    $totalIncome = $_POST['totalIncome'];

    // Error Handler
    // Checks empty fields
    if (empty($totalIncome) || empty($totalExpense) || empty($totalRevenue) || empty($dateCreated) || empty($dateStart) || empty($dateEnd)) {
      header("Location: ../gen_income_statement.php?error=emptyfields");
      exit();
    }
    else {
      $sql = "INSERT INTO incomestatementtab (dateEnd, dateStart, dateCreated, totalRevenue, totalExpense, totalIncome)
              VAlUES (?, ?, ?, ?, ?, ?)";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../gen_income_statement.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "ssssss", $dateEnd, $dateStart, $dateCreated, $totalRevenue, $totalExpense, $totalIncome);
        mysqli_stmt_execute($stmt);

        header("Location: ../income_statement_list.php?gen_income_statement=success");
        exit();
      }


    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../gen_income_statement.php");
    exit();

  }
