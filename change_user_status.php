<!DOCTYPE html>
<?php
  require "template.php";
  headertag("Change User Status");

  $sql = "SELECT *
          FROM usertab
          WHERE userID = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_GET['uid']);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $userID = $row['userID'];
    $usertype = $row['usertype'];
    $username = $row['username'];
    $userstatus = $row['userstatus'];
  }
 ?>

    <div class="container login-box">


      <div class="row form-group">
        <div class="col-sm-12 text-center form-title h3">
          Change User Status
        </div>
      </div>

      <div class="row form-group">
        <div class="col-sm-12 text-center h5">
          Are you sure you want to
          <?php
            if ($userstatus == 'Enabled'){
              ?>
                Disable
              <?php
            }
            else if ($userstatus == 'Disabled'){
              ?>
                Enable
              <?php
            }
            echo $username
          ?>
          ?
        </div>
      </div>

      <form role="form" method="post" action="includes/change_user_status.inc.php?uid=<?php echo $userID?>">

        <div class="form-group row">
          <div class="col-sm-8 offset-sm-2">
            <?php
              if ($userstatus == 'Enabled'){
                ?>
                  <input type="submit" value="Disable User" name="change_status_submit" class="btn-lg btn btn-danger btn-block"/>
                <?php
              }
              else if ($userstatus == 'Disabled'){
                ?>
                  <input type="submit" value="Enable User" name="change_status_submit" class="btn-lg btn btn-success btn-block"/>
                <?php
              }
            ?>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-6 offset-sm-3">
            <a href="search_users.php" class="btn btn-secondary btn-block">Cancel</a>
          </div>
        </div>

      </form>

    </div>
<?
  footertag();
?>
