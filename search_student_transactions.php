
<?php
  require_once "template.php";
  require_once "functions.php";
  headertag("Search Student Transactions");


?>


    <div class="container form-box">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Search Student Transactions
        </div>
      </div>

      <?php
        if (isset($_GET['error'])) {
          if ($_GET['error'] == "emptyfields") {
            echo '<div class="row form-group">
                    <div class="col-sm-12 text-center error">
                      Fill up all fields
                    </div>
                  </div>';
          }
        }
      ?>


      <form role="form" method="post" action="search_student_transactions.php">
        <div class="row form-group">
          <div class="col-sm-4">
            <a href="search_student_acct.php" class="btn btn-block btn-primary">Add Student Transaction</a>
          </div>
          <input type="text" class="form-control col-sm-4 offset-sm-2" id="student" name="student" placeholder="search student no. or name"/>
          <div class="col-sm-2">
            <input type="submit" value="Search" name="search_student_submit" class="btn btn-primary btn-block"/>
          </div>
        </div>
      </form>


      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">Date of Transaction</th>
            <th scope="col">Student No.</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Receipt No.</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if(isset($_POST['search_student_submit'])){
              search_student3($_POST['student']);
            }
            else if(!isset($_POST['search_student_submit'])) {
              studenttranslist();
            }
          ?>
        </tbody>
      </table>

    </div>
<?php
  footertag();
?>
