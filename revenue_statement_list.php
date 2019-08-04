
<?php
  require_once "template.php";
  require_once "functions.php";
  headertag("List of Revenue Statements");
?>


    <div class="container form-box">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          List of Revenue Statements
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
          <?php if ($_SESSION['usertype'] == "Accounting Supervisor"){
            ?>
            <div class="row form-group">
              <a href="gen_revenue_statement.php" class="col-sm-4 offset-sm-4 btn btn-primary btn-block"/>
              Create Revenue Statement
              </a>
            </div>
            <?php
          }?>
      </form>


      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">Date Created</th>
            <th scope="col">Total Revenue</th>
            <th scope="col">From</th>
            <th scope="col">Until</th>
          </tr>
        </thead>
        <tbody>
          <?php
            revenuestatelist();
          ?>
        </tbody>
      </table>

    </div>
<?php
  footertag();
?>
