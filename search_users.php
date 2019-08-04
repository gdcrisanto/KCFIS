
<?php
  require_once "template.php";
  require_once "functions.php";
  headertag("List of User Info");
?>


    <div class="container form-box">

      <div class="row form-group form-title">
        <div class="col-sm-12 text-center h3">
          List of Users
        </div>
      </div>

      <form role="form" method="post" action="search_staff.php">

        <div class="row form-group">
          <div class="col-sm-3">
            <a href="create_user.php" class="btn btn-block btn-primary">Add User</a>
          </div>
        </div>

      </form>

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
