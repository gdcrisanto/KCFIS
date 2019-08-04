<?php

  if (isset($_POST['edit_staff_submit'])){

    require 'db.inc.php';

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $contactno = $_POST['contactno'];
    $address = $_POST['address'];
    $employeeID = $_POST['employeeID'];
    $position = $_POST['position'];

    $sql = "SELECT *
            FROM staffinfotab
            WHERE employeeID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $employeeID);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
      $staffID = $row['staffID'];
    }

    // Error Handler
    // Checks empty fields
    if (empty($fname) || empty($lname) || empty($contactno) || empty($address) || empty($employeeID)|| empty($position)) {
      header("Location: ../edit_staff.php?error=emptyfields&fname=".$fname."&lname=".$lname."&mname=".$mname."&contactno=".$contactno);
      exit();
    }
    else {
      $sql = "UPDATE staffinfotab
              SET lname = ?, fname = ?, mname = ?, contactno = ?, address = ?, employeeID = ?, position = ?
              WHERE staffID = ?";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../edit_staff.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "ssssssi", $lname, $fname, $mname, $contactno, $address, $employeeID, $position, $staffID);
        mysqli_stmt_execute($stmt);

        header("Location: ../view_staff.php?facid=".$staffID."&edit_staff=success");
        exit();
      }


    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../edit_staff.php");
    exit();

  }
