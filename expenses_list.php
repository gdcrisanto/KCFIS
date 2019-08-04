
<?php
  require_once "template.php";
  require_once "functions.php";
  headertag("Expenses Records");
?>


    <div class="container form-box">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Expenses Records
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
          <div class="col-sm-3">
            <a href="add_expense.php" class="btn btn-block btn-primary">Record Expense</a>
          </div>
          <!-- <input type="text" class="form-control col-sm-4 offset-sm-3" id="student" name="student" placeholder="search student no. or name"/>
          <div class="col-sm-2">
            <input type="submit" value="Submit" name="search_student_submit" class="btn btn-primary btn-block"/>
          </div> -->
        </div>
      </form>


      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">Date Recorded</th>
            <th scope="col">Expense Type</th>
            <th scope="col">Amount</th>
          </tr>
        </thead>
        <tbody>
          <?php
            expenseslist();
          ?>
        </tbody>
      </table>

    </div>
<?php
  footertag();
?>
