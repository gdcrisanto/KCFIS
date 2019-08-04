<?php

  if (isset($_POST['user_info_submit'])){
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

    // var_dump($fname);
    // var_dump($lname);
    // var_dump($mname);
    // var_dump($contactno);
    // var_dump($username);
    // var_dump($birthdate);
    // var_dump($gender);
    // var_dump($address);
    // var_dump($birthplace);
    // var_dump($citizenship);

    $sql = "UPDATE 'userinfotab'
            SET 'lname'=?, 'fname'=?, 'mname'=?, 'contactno'=?, 'address'=?, 'birthdate'=?, 'gender'=?, 'birthplace'=?, 'citizenship'=?
            WHERE 'userID'=?";

    $stmt = $conn->prepare($sql);
    var_dump($_SESSION['userID']);
    $userid = $_SESSION['userID'];
    $stmt->bind_param(
      "sssssssssi", $lname, $fname, $mname, $contactno, $address, $birthdate, $gender, $birthplace, $citizenship, $userid
    );
    $stmt->execute();
    header("Location: ../edit_user.php?edit=success");
    exit();

  }
