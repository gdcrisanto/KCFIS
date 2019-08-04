<?php

  if (isset($_POST['new_pass_submit'])){

    session_start();

    require 'db.inc.php';

    $newpass = $_POST['newpass'];
    $confirmpass = $_POST['confirmpass'];
    $userID = $_SESSION['userID'];

    // Error Handler
    // Checks empty fields
    if (empty($newpass) || empty($confirmpass)) {
      header("Location: ../change_password.php?error=emptyfields");
      exit();
    }

    else if ($newpass !== $confirmpass) {
      header("Location: ../change_password.php?error=passwordcheck&user=".$username);
      exit();
    }
    //Error handler to check if new pass and confirm pass is the same
    else {
      $sql = "UPDATE usertab
              SET password = ?
              WHERE userID = ?";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */

      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../change_password.php?error=sqlerror1");
        exit();
      }
      else {
        $hashedpass = password_hash($newpass, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ss", $hashedpass, $userID);
        mysqli_stmt_execute($stmt);

        header("Location: ../index.php?changepass=success");
        exit();
      }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../change_password.php");
    exit();

  }
