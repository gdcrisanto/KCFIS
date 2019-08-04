<?php

  if (isset($_POST['gen_revenue_statement'])){

    session_start();
    require 'db.inc.php';

    $dateEnd = $_POST['dateEnd'];
    $dateStart = $_POST['dateStart'];
    $dateCreated = $_POST['dateCreated'];
    $totalRevenue = $_POST['totalRevenue'];

    // Error Handler
    // Checks empty fields
    if (empty($totalRevenue) || empty($dateCreated) || empty($dateStart) || empty($dateEnd)) {
      header("Location: ../gen_revenue_statement.php?error=emptyfields");
      exit();
    }
    else {
      $sql = "INSERT INTO revstatementtab (dateEnd, dateStart, dateCreated, totalRevenue)
              VAlUES (?, ?, ?, ?)";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../gen_revenue_statement.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "ssss", $dateEnd, $dateStart, $dateCreated, $totalRevenue);
        mysqli_stmt_execute($stmt);

        header("Location: ../revenue_statement_list.php?gen_revenue_statement=success");
        exit();
      }


    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../gen_revenue_statement.php");
    exit();

  }
