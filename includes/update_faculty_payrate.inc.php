<?php

  if (isset($_POST['faculty_payrate_submit'])){

    require 'db.inc.php';

    $facID = $_GET['facid'];
    $hourlyRate = $_POST['hourlyRate'];
    $dateUpdated = $_POST['dateUpdated'];

    // Error Handler
    // Checks empty fields
    if (empty($hourlyRate) || empty($dateUpdated)) {
      header("Location: ../update_staff_salary.php?facid=".$facID."&error=emptyfields&monthlySalary=".$hourlyRate."&dateUpdated=".$dateUpdated);
      exit();
    }
    else {
      $sql = "INSERT INTO facultyratetab (hourlyRate, dateUpdated, facID)
              VALUES (?, ?, ?)";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../update_faculty_payrate.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "isi", $hourlyRate, $dateUpdated, $facID);
        mysqli_stmt_execute($stmt);

        header("Location: ../faculty_payrate_info.php?facid=".$facID."&update_staff_salary=success");
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
