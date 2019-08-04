<?php

  if (isset($_POST['edit_faculty_submit'])){

    require 'db.inc.php';

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $contactno = $_POST['contactno'];
    $address = $_POST['address'];
    $employeeID = $_POST['employeeID'];

    $sql = "SELECT *
            FROM facultyinfotab
            WHERE employeeID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $employeeID);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
      $facID = $row['facID'];
    }

    // Error Handler
    // Checks empty fields
    if (empty($fname) || empty($lname) || empty($contactno) || empty($address) || empty($employeeID)) {
      header("Location: ../edit_faculty.php?error=emptyfields&fname=".$fname."&lname=".$lname."&mname=".$mname."&contactno=".$contactno);
      exit();
    }
    else {
      $sql = "UPDATE facultyinfotab
              SET lname = ?, fname = ?, mname = ?, contactno = ?, address = ?, employeeID = ?
              WHERE facID = ?";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../edit_faculty.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "ssssssi", $lname, $fname, $mname, $contactno, $address, $employeeID, $facID);
        mysqli_stmt_execute($stmt);

        header("Location: ../view_faculty.php?facid=".$facID."&edit_faculty=success");
        exit();
      }


    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../edit_faculty.php");
    exit();

  }
