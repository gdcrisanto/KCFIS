
<?php
  require_once "template.php";
  require_once "functions.php";
  headertag("Enable/ Disable User");
?>


    <div class="container form-box">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          Enable/ Disable Users
        </div>
      </div>

      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">User Status</th>
            <th scope="col">User Type</th>
            <th scope="col">Username</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if(isset($_POST['search_staff_submit'])){
              search_user();
            }
            else if(!isset($_POST['search_staff_submit'])) {
              userlist2();
            }
          ?>
        </tbody>
      </table>

    </div>
<?php
  footertag();
?>
