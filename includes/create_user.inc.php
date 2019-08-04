<?php

  if (isset($_POST['create_user_submit'])){

    require 'db.inc.php';

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $contactno = $_POST['contactno'];
    $username = $_POST['user'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $usertype = $_POST['usertype'];


    // Error Handler
    // Checks empty fields
    if (empty($fname) || empty($lname) || empty($contactno) || empty($username) || empty($password) || empty($confirmpassword) || empty($usertype)) {
      header("Location: ../create_user.php?error=emptyfields&fname=".$fname."&lname=".$lname."&mname=".$mname."&contactno=".$contactno."&user=".$username."&usertype=".$usertype);
      echo $usertype;
      exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)){
      header("Location: ../create_user.php?error=invalidusername");
      exit();
    }
    else if ($password !== $confirmpassword) {
      header("Location: ../create_user.php?error=passwordcheck&user=".$username);
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
        header("Location: ../create_user.php?error=sqlerror1");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck > 0) {
          header("Location: ../create_user.php?error=usernametaken");
          exit();
        }
        else {
          $sql = "INSERT INTO usertab (username, password, usertype)
                  VALUES (?, ?, ?)";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../create_user.php?error=sqlerror2");
            exit();
          }

          $hashedpass = password_hash($password, PASSWORD_DEFAULT);

          mysqli_stmt_bind_param($stmt, "sss", $username, $hashedpass, $usertype);
          mysqli_stmt_execute($stmt);

          $user_id = $conn->insert_id;

          $sql = "INSERT INTO userinfotab (userid, lname, fname, mname, contactno)
                  VALUES (?, ?, ?, ?, ?)";

          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../create_user.php?error=sqlerror3");
            exit();
          }

          mysqli_stmt_bind_param($stmt, "isssi", $user_id, $lname, $fname, $mname, $contactno);
          mysqli_stmt_execute($stmt);
          header("Location: ../create_user.php?create_user=success");
          exit();

        }

      }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

  }
  else{
    header("Location: ../create_user.php");
    exit();

  }
