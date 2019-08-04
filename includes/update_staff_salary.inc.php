<?php

  if (isset($_POST['staff_salary_submit'])){

    require 'db.inc.php';

    $staffID = $_GET['staffid'];
    $monthlySalary = $_POST['monthlySalary'];
    $dateUpdated = $_POST['dateUpdated'];

    // Error Handler
    // Checks empty fields
    if (empty($monthlySalary) || empty($dateUpdated)) {
      header("Location: ../update_staff_salary.php?staffid=".$staffID."&error=emptyfields&monthlySalary=".$monthlySalary."&dateUpdated=".$dateUpdated);
      exit();
    }
    else {
      $sql = "INSERT INTO staffsalarytab (monthlySalary, dateUpdated, staffID)
              VALUES (?, ?, ?)";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../update_staff_salary.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "isi", $monthlySalary, $dateUpdated, $staffID);
        mysqli_stmt_execute($stmt);

        header("Location: ../staff_salary_info.php?staffid=".$staffID."&update_staff_salary=success");
        exit();
      }


    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../update_staff_salary.php");
    exit();

  }
