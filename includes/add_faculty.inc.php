<?php

  if (isset($_POST['add_faculty_submit'])){

    require 'db.inc.php';

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $contactno = $_POST['contactno'];
    $address = $_POST['address'];
    $employeeID = $_POST['employeeID'];


    // Error Handler
    // Checks empty fields
    if (empty($fname) || empty($lname) || empty($contactno) || empty($address) || empty($employeeID)) {
      header("Location: ../add_faculty.php?error=emptyfields&fname=".$fname."&lname=".$lname."&mname=".$mname."&contactno=".$contactno);
      exit();
    }
    else {
      $sql = "INSERT INTO facultyinfotab (lname, fname, mname, contactno, address, employeeID)
              VAlUES (?, ?, ?, ?, ?, ?)";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../add_faculty.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "ssssss", $lname, $fname, $mname, $contactno, $address, $employeeID);
        mysqli_stmt_execute($stmt);

        header("Location: ../search_faculty.php?add_faculty=success");
        exit();
      }


    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../add_faculty.php");
    exit();

  }
