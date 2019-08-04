<?php
// template.php
session_start();
require_once "includes/db.inc.php";
require ("fpdf181/fpdf.php");

function headertag($title){
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- Bootstrap dependencies -->
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Internal CSS -->
    <style>

      .btn {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      }

      #header{
        background-color: #FCFEFF;
        border-bottom-left-radius: 7px;
        border-bottom-right-radius: 7px;
        height: 65px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        --font-family-sans-serif: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        --font-family-monospace: SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;
      }

      .error{
        color: red;
      }

      .form-box{
        border-radius: 15px;
        height: auto;
        width: 800px;
        background-color: #FCFEFF;
        padding-top: 25px;
        padding-bottom: 30px;
        margin-bottom: 60px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        --font-family-sans-serif: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        --font-family-monospace: SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;
      }

      .form-box-sm{
        border-radius: 15px;
        height: auto;
        width: 400px;
        background-color: #FCFEFF;
        padding-top: 25px;
        padding-bottom: 30px;
        margin-bottom: 60px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        --font-family-sans-serif: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        --font-family-monospace: SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;
      }

      .form-box-md{
        border-radius: 15px;
        height: auto;
        width: 600px;
        background-color: #FCFEFF;
        padding-top: 25px;
        padding-bottom: 30px;
        margin-bottom: 60px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        --font-family-sans-serif: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        --font-family-monospace: SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;
      }

      .login-box{
        border-radius: 15px;
        height: auto;
        width: 400px;
        background-color: #FCFEFF;
        padding-top: 30px;
        padding-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        --font-family-sans-serif: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        --font-family-monospace: SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;
      }

      #loginuser{
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
      }

      #loginpassword{
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
      }

      .form-title {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        background-color: #1096EA;
        padding-top: 5px;
        padding-bottom: 5px;
        margin-bottom: 25px;
        color: #4d4d4d;
      }

    </style>
  </head>
  <body style="background-color: #8EB1C7">

    <nav class="navbar navbar-expand-lg navbar-light mb-sm-5 sticky-top" id="header">
      <a class="navbar-brand h5">
        <img src="photos/KC_logo_2.jpg" width="39" height="39" class="rounded-circle d-inline-block align-top">
        K.C.F.I.S.
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <?php
          if (isset($_SESSION['username'])) {
            ?>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <?php if (($_SESSION['usertype'] == "Cashier") || ($_SESSION['usertype'] == "Data Encoder")) {
                ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Income
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <?php if ($_SESSION['usertype'] == "Cashier"){
                      ?>
                      <a class="dropdown-item" href="search_student_acct.php">list of student accounts</a>
                      <a class="dropdown-item" href="search_student_transactions.php">list of student transactions</a>
                      <a class="dropdown-item" href="other_income_list.php">list of other income transactions</a>
                      <?php
                    }?>
                    <?php if ($_SESSION['usertype'] == "Data Encoder"){
                      ?>
                      <a class="dropdown-item" href="search_student.php">list of students</a>
                      <?php
                    }?>
                  </div>
                </li>
                <?php
              }?>
              <?php if ($_SESSION['usertype'] == "Accounting Supervisor") {
                ?>
                <li class="nav-item">
                  <a class="nav-link" href="expenses_list.php">Expenses</a>
                </li>
                <?php
              } ?>
              <?php if (($_SESSION['usertype'] == "Accounting Supervisor") || ($_SESSION['usertype'] == "Data Encoder")) {
                ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Employees
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <?php if (($_SESSION['usertype'] == "Accounting Supervisor") || ($_SESSION['usertype'] == "Data Encoder")){
                      ?>
                      <a class="dropdown-item" href="search_faculty.php">list of faculty</a>
                      <a class="dropdown-item" href="search_staff.php">list of staff</a>
                      <?php
                    }?>
                    <?php if ($_SESSION['usertype'] == "Accounting Supervisor"){
                      ?>
                      <a class="dropdown-item" href="faculty_salstatement_list.php">faculty salary statements</a>
                      <a class="dropdown-item" href="staff_salstatement_list.php">staff salary statements</a>
                      <?php
                    }?>
                  </div>
                </li>
                <?php
              } ?>
              <?php if (($_SESSION['usertype'] == "Accounting Supervisor") || ($_SESSION['usertype'] == "Finance Admin")) {
                ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Reports
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="outstanding_balances.php">list of outstanding balances</a>
                    <a class="dropdown-item" href="income_statement_list.php">list of income statements</a>
                    <a class="dropdown-item" href="revenue_statement_list.php">list of revenue statements</a>
                    <a class="dropdown-item" href="expense_statement_list.php">list of expense statements</a>
                  </div>
                </li>
                <?php
              }?>
              <?php if ($_SESSION['usertype'] == "System Admin") {
                ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Maintenance
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="search_users.php">list of users</a>
                    <a class="dropdown-item" href="system_backup.php">backup system</a>
                  </div>
                </li>
                <?php
              }?>
            </ul>
            <?php
            }
          ?>
      </div>

      <?php
        if (isset($_SESSION['username'])) {
          ?>
          <form action="includes/logout.inc.php" method="post">
            <input type="submit" value="Log out" name="login_submit" class="btn btn-primary"/>
          </form>
          <?php
        }
      ?>
    </nav>

  <?php
}

function footertag(){
  ?>
</div>
</body>
</html>
  <?php
}

 ?>
