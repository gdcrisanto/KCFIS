
<?php
  require_once "template.php";
  require_once "functions.php";
  headertag("Search Faculty Info");
?>


    <div class="container form-box">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Search Faculty Info
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

      <form role="form" method="post" action="search_faculty.php">

        <div class="row form-group">
          <?php
            if($_SESSION['usertype']=="Data Encoder"){
              ?>
              <div class="col-sm-3">
                <a href="add_faculty.php" class="btn btn-block btn-primary">Add Faculty</a>
                <a href="import_faculty.php" class="btn btn-block btn-secondary">Import Faculty Info</a>
              </div>
              <?php
            }
          ?>
          <input type="text" class="form-control col-sm-4 offset-sm-3" id="faculty" name="faculty" placeholder="search employee ID or name">
          <div class="col-sm-2">
            <input type="submit" value="Search" name="search_faculty_submit" class="btn btn-primary btn-block"/>
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
              search_faculty($_POST['faculty']);
            }
            else if(!isset($_POST['search_faculty_submit'])) {
              facultylist();
            }
          ?>
        </tbody>
      </table>

    </div>
<?php
  footertag();
?>
