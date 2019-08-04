<?php

  if (isset($_POST['add_fac_salary_statement_submit'])){
    session_start();
    require 'db.inc.php';

    $dateIssued = $_POST['dateIssued'];
    $hourlyRate = $_POST['hourlyRate'];
    $hoursWorked = $_POST['hoursWorked'];
    $grossIncome = $_POST['grossIncome'];
    $withholdingTax = $_POST['withholdingTax'];
    $netIncome = $_POST['netIncome'];
    $facID = $_GET['facid'];
    $userID = $_SESSION['userID'];

    // Error Handler
    // Checks empty fields
    if (empty($hoursWorked)) {
      header("Location: ../add_faculty_salary_statement.php?facid=".$facID."&error=emptyfields");
      exit();
    }
    else {
      $sql = "INSERT INTO facsalarystatementtab (grossIncome, netIncome, withholdingTax, hourlyRate, hoursWorked, dateIssued, facID)
              VAlUES (?, ?, ?, ?, ?, ?, ?)";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../add_faculty_salary_statement.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "sssssss", $grossIncome, $netIncome, $withholdingTax, $hourlyRate, $hoursWorked, $dateIssued, $facID);
        mysqli_stmt_execute($stmt);

        header("Location: ../faculty_salstatement_list.php?add_faculty_salary_statement=success");
        exit();
      }


    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../add_faculty_salary_statement.php");
    exit();

  }
