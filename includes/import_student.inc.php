<?php

  if (isset($_POST['import_student_submit'])){

    require 'db.inc.php';
    $csv = $_FILES['studentcsv']['tmp_name'];

    // Error Handler
    // Checks empty fields
    if (empty($_FILES['studentcsv']['tmp_name'])) {
      header("Location: ../search_student.php?error=emptyfields");
      exit();
    }
    else {
      $csv = fopen($csv, 'r');
      $i = 0;
      while ($row = fgetcsv($csv)){
        if($i > 0){
          $value = "'". implode("','", $row) ."'";
          $sql = "INSERT INTO studentinfotab (studentno, lname, fname, mname, contactno, address)
                  VALUES (". $value .")";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../search_student.php?error=sqlerror1");
            exit();
            /* Error handler to check if access to db is permitted */
          }
          else {
            mysqli_stmt_execute($stmt);
          }
        }
        $i++;
      }
      header("Location: ../search_student.php?import_stud_info=success");
      exit();
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../search_student.php");
    exit();

  }
