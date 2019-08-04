<?php

  if (isset($_POST['user_info_submit'])){

    session_start();

    require 'db.inc.php';

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $contactno = $_POST['contactno'];
    $username = $_POST['user'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $birthplace = $_POST['birthplace'];
    $citizenship = $_POST['citizenship'];
    var_dump($_SESSION['userID']);

    // Error Handler
    // Checks empty fields
    if (empty($fname) || empty($lname) || empty($mname) || empty($contactno) || empty($citizenship) || empty($birthplace) || empty($address) || empty($gender) || empty($birthdate) || empty($username)) {
      header("Location: ../edit_user.php?error=emptyfields&fname=".$fname."&lname=".$lname."&mname=".$mname."&contactno=".$contactno."&user=".$username);
      exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)){
      header("Location: ../edit_user.php?error=invalidusername");
      exit();
    }
    //Error handler to check if username is already existing
    else {
      $sql = "SELECT username
              FROM usertab
              WHERE username=?";

      $stmt = mysqli_stmt_init($conn);

      /* Error handler to check if access to db is permitted */

      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../edit_user.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck < 0) {
          header("Location: ../edit_user.php?error=usernametaken");
          exit();
        }
        else {
          $sql = "UPDATE usertab
                  SET username = ?
                  WHERE userID = ? ";

          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../edit_user.php?error=sqlerror2");
            exit();
          }

          mysqli_stmt_bind_param($stmt, "si", $username, $_SESSION['userID']);
          mysqli_stmt_execute($stmt);

          $sql = "UPDATE `userinfotab`
                  SET `lname` = ?, `fname` = ?, `mname` = ?, `contactno` = ?, `address` = ?, `birthdate` = ?, `gender` = ?, `birthplace` = ?, `citizenship` = ?
                  WHERE `userID` = ?";

          $userid = $_SESSION['userID'];

          $stmt = $conn->prepare($sql);

          $stmt->bind_param(
            "sssssssssi", $lname, $fname, $mname, $contactno, $address, $birthdate, $gender, $birthplace, $citizenship, $userid
          );
          $stmt->execute();

          header("Location: ../view_user.php?edit=success");
          exit();

        }

      }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../edit_user.php");
    exit();

  }
