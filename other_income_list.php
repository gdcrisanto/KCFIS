
<?php
  require_once "template.php";
  require_once "functions.php";
  headertag("Other Income Records");
?>


    <div class="container form-box">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Other Income Records
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


      <form role="form" method="post" action="other_income_list.php">
        <div class="row form-group">
          <div class="col-sm-4">
            <a href="add_other_income.php" class="btn btn-block btn-primary">Record Other Income</a>
          </div>
          <input type="text" class="form-control col-sm-4 offset-sm-2" name="search" placeholder="search receipt no. or name"/>
          <div class="col-sm-2">
            <input type="submit" value="Search" name="search_student_submit" class="btn btn-primary btn-block"/>
          </div>
        </div>
      </form>


      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">Date Received</th>
            <th scope="col">Received From</th>
            <th scope="col">Amount</th>
            <th scope="col">Receipt No.</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if (isset($_POST['search_student_submit'])){
              otherincomesearch($_POST['search']);
            }
            else if (!isset($_POST['search_student_submit'])){
              otherincomelist();
            }
          ?>
        </tbody>
      </table>

    </div>
<?php
  footertag();
?>
