<?php

  if (isset($_POST['add_staff_salary_statement_submit'])){
    session_start();
    require 'db.inc.php';

    $dateIssued = $_POST['dateIssued'];
    $grossIncome = $_POST['grossIncome'];
    $netIncome = $_POST['netIncome'];
    $monthlySalary = $_POST['monthlySalary'] ;

    $withholdingTax = $_POST['withholdingTax'];
    $overtimePays = $_POST['overtimePays'] ;
    $paidLeaves = $_POST['paidLeaves'] ;
    $adjustmentsAdd = $_POST['adjustmentsAdd'] ;
    $sss = $_POST['sss'] ;
    $philhealth = $_POST['philhealth'] ;
    $pagibig = $_POST['pagibig'] ;
    $personalLoans = $_POST['personalLoans'] ;
    $undertime = $_POST['undertime'] ;
    $absences = $_POST['absences'] ;
    $adjustmentsDeduc = $_POST['adjustmentsDeduc'] ;
    $staffID = $_GET['staffid'];
    $userID = $_SESSION['userID'];


    // Error Handler
    // Checks empty fields
    if (empty($monthlySalary)) {
      header("Location: ../add_staff_salary_statement.php?staffid=".$staffID."&error=emptyfields");
      exit();
    }
    else {
      $sql = "INSERT INTO staffsalarystatementtab (grossIncome, netIncome, withholdingTax, overtimePays, paidLeaves, adjustmentsAdd, sss, philhealth, pagibig, personalLoans, undertime, absences, adjustmentsDeduc, dateIssued, staffID, monthlySalary)
              VAlUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../add_staff_salary_statement.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "ssssssssssssssss", $grossIncome, $netIncome, $withholdingTax, $overtimePays, $paidLeaves, $adjustmentsAdd, $sss, $philhealth, $pagibig, $personalLoans, $undertime, $absences, $adjustmentsDeduc, $dateIssued, $staffID, $monthlySalary);
        mysqli_stmt_execute($stmt);

        header("Location: ../staff_salstatement_list.php?add_staff_salary_statement=success");
        exit();
      }


    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../add_staff_salary_statement.php");
    exit();

  }
