
<?php
  require_once "template.php";
  require_once "functions.php";
  headertag("Search Staff Member");
?>


    <div class="container form-box-md">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Search Staff Member
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

      <form role="form" method="post" action="search_staff2.php">

        <div class="row form-group">
          <input type="text" class="form-control col-sm-5 offset-sm-4" id="faculty" name="faculty" placeholder="search employee ID or name">
          <div class="col-sm-3">
            <input type="submit" value="Submit" name="search_staff_submit" class="btn btn-primary btn-block"/>
          </div>
        </div>

      </form>

      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">Employee ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if(isset($_POST['search_faculty_submit'])){
              search_staff2();
            }
            else if(!isset($_POST['search_faculty_submit'])) {
              stafflist2();
            }
          ?>
        </tbody>
      </table>

    </div>
<?php
  footertag();
?>
