<?php

  if (isset($_POST['edit_student_submit'])){

    require 'db.inc.php';

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $contactno = $_POST['contactno'];
    $address = $_POST['address'];
    $studentno = $_POST['studentno'];

    $sql = "SELECT *
            FROM studentinfotab
            WHERE studentno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $studentno);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
      $studID = $row['studID'];
    }

    // Error Handler
    // Checks empty fields
    if (empty($fname) || empty($lname) || empty($contactno) || empty($address) || empty($studentno)) {
      header("Location: ../edit_student.php?error=emptyfields&fname=".$fname."&lname=".$lname."&mname=".$mname."&contactno=".$contactno);
      exit();
    }
    else {
      $sql = "UPDATE studentinfotab
              SET lname = ?, fname = ?, mname = ?, contactno = ?, address = ?, studentno = ?
              WHERE studID = ?";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../edit_student.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "ssssssi", $lname, $fname, $mname, $contactno, $address, $studentno, $studID);
        mysqli_stmt_execute($stmt);

        header("Location: ../view_student.php?studid=".$studID."&edit_student=success");
        exit();
      }


    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../edit_student.php");
    exit();

  }
