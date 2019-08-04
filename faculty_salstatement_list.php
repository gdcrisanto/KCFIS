
<?php
  require_once "template.php";
  require_once "functions.php";
  headertag("Faculty Salary Statements");
?>


    <div class="container form-box-md">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Faculty Salary Statement List
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

      <div class="row form-group">
        <div class="col-sm-5 offset-sm-7">
          <a href="search_faculty2.php?" class="btn btn-block btn-primary">Record Salary Statement</a>
        </div>
      </div>

      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Employee ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
          </tr>
        </thead>
        <tbody>
          <?php
            facultystatementlist();
          ?>
        </tbody>
      </table>

    </div>
<?php
  footertag();
?>
