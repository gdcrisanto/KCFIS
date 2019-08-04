<!DOCTYPE html>
<?php
  require "template.php";
  headertag("Backup System");

  $stmt = $conn->prepare("SELECT *
                          FROM systembackuptab
                          WHERE dateSaved = (SELECT max(dateSaved) FROM systembackuptab)");
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()){
    $dateSaved = $row['dateSaved'];
  }
 ?>

    <div class="container login-box">


      <?php
        if (isset($_GET['error'])) {
          if ($_GET['error'] == "emptyfields") {
            echo '<div class="row form-group">
                    <div class="col-sm-12 text-center error">
                      Enter username and password
                    </div>
                  </div>';
          }
          else if ($_GET['error'] == "invusrpass") {
            echo '<div class="row form-group">
                    <div class="col-sm-12 text-center error">
                      Invalid username or password
                    </div>
                  </div>';
          }
        }
      ?>

      <form role="form" method="post" action="includes/database-backup.php">

        <div class="row form-group form-title">
          <div class="col-sm-12 text-center h3">
            Backup System Database
          </div>
        </div>

        <div class="form-group row mb-4">
          <div class="col-sm-6 offset-sm-3">
            Previous Saved State:
            <input readonly value="<?php echo $dateSaved?>" type="datetime" class="form-control"/>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-8 offset-sm-2">
            <input type="submit" value="Create Backup" name="system_bacup" class="btn btn-primary btn-block btn-lg"/>
          </div>
        </div>

      </form>

    </div>
<?
  footertag();
?>
