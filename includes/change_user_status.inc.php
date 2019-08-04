<?php

  if (isset($_POST['change_status_submit'])){
    session_start();
    require 'db.inc.php';

    $userID = $_GET['uid'];

    if (empty($userID)) {
      header("Location: ../search_users.php?error=emptyfields");
      exit();
    }
    else {
      $sql = "UPDATE usertab
              SET userstatus = ?
              WHERE userID = ? ";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../search_users.php?error=sqlerror1");
        exit();
      }
      else {
        if ($_POST['change_status_submit'] == 'Disable User'){
          $userstatus = "Disabled";
        }
        else if ($_POST['change_status_submit'] == 'Enable User'){
          $userstatus = "Enabled";
        }
        mysqli_stmt_bind_param($stmt, "ss", $userstatus, $userID);
        mysqli_stmt_execute($stmt);

        header("Location: ../search_users.php?changeus=success");
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
