<?php

  if (isset($_POST['import_faculty_submit'])){

    require 'db.inc.php';
    $csv = $_FILES['facultycsv']['tmp_name'];

    // Error Handler
    // Checks empty fields
    if (empty($_FILES['facultycsv']['tmp_name'])) {
      header("Location: ../search_faculty.php?error=emptyfields");
      exit();
    }
    else {
      $csv = fopen($csv, 'r');
      $i = 0;
      while ($row = fgetcsv($csv)){
        if($i > 0){
          $value = "'". implode("','", $row) ."'";
          $sql = "INSERT INTO facultyinfotab (lname, fname, mname, contactno, employeeID, address)
                  VALUES (". $value .")";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../search_faculty.php?error=sqlerror1");
            exit();
            /* Error handler to check if access to db is permitted */
          }
          else {
            mysqli_stmt_execute($stmt);
          }
        }
        $i++;
      }
      header("Location: ../search_faculty.php?import_fac_info=success");
      exit();
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../search_faculty.php");
    exit();

  }
