<?php

if (isset($_POST['login_submit'])) {

  require 'db.inc.php';

  $username = $_POST['user'];
  $password = $_POST['password'];

  if(empty($username) || empty($password)) {
    header("Location: ../login_page.php?error=emptyfields");
    exit();
  }
  else {
    $sql = "SELECT *
            FROM usertab
            WHERE username=?";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../login_page.php?error=sqlerror");
      exit();
    }
    else {

      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $passcheck = password_verify($password, $row['password']);
        $userstatus = $row['userstatus'];
        if ($userstatus == "Disabled"){
          header("Location: ../login_page.php?error=invusrpass");
          exit();
        }
        if ($passcheck == false) {
          header("Location: ../login_page.php?error=invusrpass");
          exit();
        }
        else if ($passcheck == true) {
          session_start();
          $_SESSION['userID'] = $row['userID'];
          $_SESSION['username'] = $row['username'];
          $_SESSION['usertype'] = $row['usertype'];

          $stmt = $conn->prepare("SELECT * FROM userinfotab WHERE userID = ?");
          $stmt->bind_param("s", $_SESSION['userID']);
          $stmt->execute();
          $result = $stmt->get_result();
          while($row = $result->fetch_assoc()){
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['lname'] = $row['lname'];
          }

          header("Location: ../index.php?login=success");
          exit();
        }
        else {
          header("Location: ../login_page.php?error=invusrpass");
          exit();
        }
      }
      else{
        header("Location: ../login_page.php?error=invusrpass");
        exit();
      }

    }

  }

}
else {
  header("Location: ../login_page.php");
  exit();
}
