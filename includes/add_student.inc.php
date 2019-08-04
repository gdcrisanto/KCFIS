<?php

  if (isset($_POST['add_student_submit'])){

    require 'db.inc.php';

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $contactno = $_POST['contactno'];
    $address = $_POST['address'];
    $studentno = $_POST['studentno'];


    // Error Handler
    // Checks empty fields
    if (empty($fname) || empty($lname) || empty($contactno) || empty($address) || empty($studentno)) {
      header("Location: ../add_student.php?error=emptyfields&fname=".$fname."&lname=".$lname."&mname=".$mname."&contactno=".$contactno);
      exit();
    }
    else {
      $sql = "INSERT INTO studentinfotab (lname, fname, mname, contactno, address, studentno)
              VAlUES (?, ?, ?, ?, ?, ?)";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../add_student.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "ssssss", $lname, $fname, $mname, $contactno, $address, $studentno);
        mysqli_stmt_execute($stmt);

        header("Location: ../add_student.php?add_student=success");
        exit();
      }


    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../add_student.php");
    exit();

  }
