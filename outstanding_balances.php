
<?php
  require_once "template.php";
  require_once "functions.php";
  headertag("Outstanding Balances");


?>


    <div class="container form-box">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Outstanding Balances
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


      <form role="form" method="post" action="search_student.php">
        <div class="row form-group">
          <input type="text" class="form-control col-sm-4 offset-sm-4" id="student" name="student" placeholder="search student no. or name"/>
          <div class="col-sm-2">
            <input type="submit" value="Submit" name="search_student_submit" class="btn btn-primary btn-block"/>
          </div>
        </div>
      </form>


      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">Account No.</th>
            <th scope="col">Student No.</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Remaining Balance</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if(isset($_POST['search_student_submit'])){
              search_student4();
            }
            else if(!isset($_POST['search_student_submit'])) {
              outstandingbalances();
            }
          ?>
        </tbody>
      </table>

    </div>
<?php
  footertag();
?>
