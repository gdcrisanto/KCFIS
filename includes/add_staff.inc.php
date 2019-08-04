<?php

  if (isset($_POST['add_staff_submit'])){

    require 'db.inc.php';

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $contactno = $_POST['contactno'];
    $address = $_POST['address'];
    $employeeID = $_POST['employeeID'];
    $position = $_POST['position'];


    // Error Handler
    // Checks empty fields
    if (empty($fname) || empty($lname) || empty($contactno) || empty($address) || empty($employeeID) || empty($position)) {
      header("Location: ../add_staff.php?error=emptyfields&fname=".$fname."&lname=".$lname."&mname=".$mname."&contactno=".$contactno);
      exit();
    }
    else {
      $sql = "INSERT INTO staffinfotab (lname, fname, mname, contactno, address, employeeID, position)
              VAlUES (?, ?, ?, ?, ?, ?, ?)";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../add_staff.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "sssssss", $lname, $fname, $mname, $contactno, $address, $employeeID, $position);
        mysqli_stmt_execute($stmt);

        header("Location: ../search_staff.php?add_staff=success");
        exit();
      }


    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../add_staff.php");
    exit();

  }
