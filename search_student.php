
<?php
  require_once "template.php";
  require_once "functions.php";
  headertag("Search Student Info");
?>


    <div class="container form-box">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Search Student Info
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
            <a href="add_student.php" class="btn btn-block btn-primary">Add Student</a>
            <a href="import_student.php" class="btn btn-block btn-secondary">Import Student Info</a>
          </div>
          <input type="text" class="form-control col-sm-4 offset-sm-3" id="student" name="student" placeholder="search student no. or name"/>
          <div class="col-sm-2">
            <input type="submit" value="Submit" name="search_student_submit" class="btn btn-primary btn-block"/>
          </div>
        </div>
      </form>


      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">Student No.</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if(isset($_POST['search_student_submit'])){
              search_student($_POST['student']);
            }
            else if(!isset($_POST['search_student_submit'])) {
              studentlist();
            }
          ?>
        </tbody>
      </table>

    </div>
<?php
  footertag();
?>
